<?php

namespace App\Http\Controllers;

use App\Models\Entree;
use App\Models\Historique;
use App\Models\Medicament;
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
                'medicaments.forme',
            )->orderBy('id', 'desc')->get();
        return response()->json($sortie, 200);
    }

    public function store(Request $request)
    {
        $medicament = Medicament::where('id', $request->idMedicament)->first();
        $stock = Stock::where('id', $request->id)->first();
        Sortie::create(
            [
                'idMedicament' => $request->idMedicament,
                'quantiteSortie' => $request->quantiteSortie,
                'dateSortie' => $request->formattedDate,
                'destination' => $request->destination,
                'observation' => $request->observation,
                'lot' => $request->lot,
            ]
        );

        if ($stock->quantiteStock > 0) {
            Stock::where('id', $request->id)
                ->update(
                    [
                        'quantiteStock' => $stock->quantiteStock - $request->quantiteSortie,
                        'quantiteUnitaire' => ($stock->quantiteStock - $request->quantiteSortie) * $medicament->nombreParBoite,
                    ]
                );
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
        $stock = Stock::where('idMedicament', $request->idM)->first();
        $initial = ($stock->quantiteUnitaire) + $sortie->quantiteSortie;
        Sortie::where('id', $id)->update(
            [
                'quantiteSortie' => $request->quantiteSortie,
            ]
        );
        Stock::where('idMedicament', $request->idM)->update(
            [
                'quantitePlaquette' => ($initial - $request->quantiteSortie) / $medicament->nombrePlaquette,
                'quantiteUnitaire' => $initial - $request->quantiteSortie,
            ]
        );
        return response()->json(['message' => 'Success edited'], 200);
    }

    public function destroy($id)
    {
        $sortie = Sortie::where('id', $id)->first();
        Sortie::destroy($id);
        $medicament = Medicament::where('id', $sortie->idMedicament)->first();
        $stock = Stock::where('idMedicament', $medicament->id)->first();
        Stock::where('idMedicament', $sortie->idMedicament)
            ->update(
                [
                    'quantitePlaquette' => ($stock->quantiteUnitaire + $sortie->quantiteSortie) / $medicament->nombrePlaquette,
                    'quantiteUnitaire' => $stock->quantiteUnitaire + $sortie->quantiteSortie,
                ]
            );
        return response()->json(['message' => "Suppresion d'entrée avec succèss"], 200);
    }
}
