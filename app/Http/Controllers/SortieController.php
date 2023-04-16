<?php

namespace App\Http\Controllers;

use App\Models\Entree;
use App\Models\Historique;
use App\Models\Medicament;
use App\Models\Pharmacie;
use App\Models\Sortie;
use App\Models\Stock;
use Illuminate\Http\Request;

class SortieController extends Controller
{
    public function index()
    {
        $sortie = Sortie::join('medicaments', 'medicaments.id', '=', 'sorties.idMedicament')
            ->select(
                'sorties.*',
                'medicaments.id as idMedicament',
                'medicaments.denomination',
                'medicaments.nombreParBoite',
                'medicaments.presentation',
                'medicaments.forme',
            )->orderBy('id', 'desc')->get();
        return response()->json($sortie, 200);
    }

    public function store(Request $request)
    {
        $medicament = Medicament::where('id', $request->idMedicament)->first();
        $stock = Stock::where('id', $request->id)->first();
        $pharmacie = Pharmacie::where('idMedicament', $request->idMedicament)
            ->where('dateExpiration', $stock->dateExpiration)->first();
        Sortie::create(
            [
                'idMedicament' => $request->idMedicament,
                'quantiteSortie' => $request->quantiteSortie,
                'dateSortie' => $request->formattedDate,
                'destination' => $request->destination,
                'observation' => $request->observation,
                'dateExpiration' => $stock->dateExpiration,
                'lot' => $request->lot,
            ]
        );

        if ($pharmacie) {
            Pharmacie::where('idMedicament', $request->idMedicament)
                ->update(
                    [
                        'quantitePharmacie' => $pharmacie->quantitePharmacie + $request->quantiteSortie * $medicament->nombreParBoite,
                    ]
                );
        } else if (!$pharmacie) {
            Pharmacie::create(
                [
                    'idMedicament' => $request->idMedicament,
                    'quantitePharmacie' => $request->quantiteSortie * $medicament->nombreParBoite,
                    'dateExpiration' => $stock->dateExpiration,
                ]
            );
        };

        if ($stock->quantiteStock > 0) {
            Stock::where('id', $request->id)
                ->update(
                    [
                        'quantiteStock' => $stock->quantiteStock - $request->quantiteSortie,
                        'quantiteUnitaire' => ($stock->quantiteStock - $request->quantiteSortie) * $medicament->nombreParBoite,
                    ]
                );
        } else {
            return response()->json(['message' => 'Un erreur se produit'], 500);
        }

        Historique::create(
            [
                'idMedicament' => $request->idMedicament,
                'type' => 0,
            ]
        );
        return response()->json(['message' => 'Sortie avec succèss'], 200);
    }

    public function update(Request $request, $id)
    {
        $sortie = Sortie::where('id', $id)->first();
        $medicament = Medicament::where('id', $request->idM)->first();
        $stock = Stock::where('idMedicament', $request->idM)
            ->where('dateExpiration', $request->dateE)->first();
        $pharmacie = Pharmacie::where('idMedicament', $request->idM)
            ->where('dateExpiration', $request->dateE)->first();
        $initial = $stock->quantiteStock + $sortie->quantiteSortie;
        $initialPharma = $pharmacie->quantitePharmacie - ($sortie->quantiteSortie * $medicament->nombreParBoite);
        Sortie::where('id', $id)->update(
            [
                'quantiteSortie' => $request->quantiteSortie,
            ]
        );
        Stock::where('idMedicament', $request->idM)
            ->where('dateExpiration', $request->dateE)->update(
                [
                    'quantiteStock' => $initial - $request->quantiteSortie,
                    'quantiteUnitaire' => ($initial - $request->quantiteSortie) * $medicament->nombreParBoite,
                ]
            );
        Pharmacie::where('idMedicament', $request->idM)
            ->where('dateExpiration', $request->dateE)->update(
                [
                    'quantitePharmacie' => $initialPharma + ($request->quantiteSortie * $medicament->nombreParBoite),
                ]
            );
        return response()->json(['message' => 'Success edited'], 200);
    }

    public function destroy($id)
    {
        $sortie = Sortie::where('id', $id)->first();
        Sortie::destroy($id);
        $medicament = Medicament::where('id', $sortie->idMedicament)->first();
        $stock = Stock::where('idMedicament', $medicament->id)
            ->where('dateExpiration', $sortie->dateExpiration)
            ->first();
        Stock::where('idMedicament', $sortie->idMedicament)
            ->where('dateExpiration', $sortie->dateExpiration)
            ->update(
                [
                    'quantiteStock' => $stock->quantiteStock + $sortie->quantiteSortie,
                    'quantiteUnitaire' => ($stock->quantiteStock + $sortie->quantiteSortie) * $medicament->nombreParBoite,
                ]
            );
        return response()->json(['message' => "Suppression d'entrée avec succèss"], 200);
    }
}
