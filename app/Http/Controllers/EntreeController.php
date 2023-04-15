<?php

namespace App\Http\Controllers;

use App\Models\Entree;
use App\Models\Historique;
use App\Models\Medicament;
use App\Models\Stock;
use Illuminate\Http\Request;

class EntreeController extends Controller
{
    public function index()
    {
        $entree = Entree::join('medicaments', 'medicaments.id', '=', 'entrees.idMedicament')
            ->select(
                'entrees.*',
                'medicaments.id as idMedicament',
                'medicaments.denomination',
                'medicaments.nombreParBoite',
                'medicaments.forme',
                'medicaments.presentation',
            )
            ->get();
        return response()->json($entree);
    }

    public function store(Request $request)
    {
        $medicament = Medicament::where('id', $request->id)->first();
        $stock = Stock::where('idMedicament', $request->id)->first();
        Entree::create(
            [
                'idMedicament' => $request->id,
                'quantiteEntree' => $request->quantiteEntree,
                'dateEntree' => $request->dateEntree,
                'dateExpiration' => $request->dateExp,
                'observation' => $request->observation,
                'lot' => $request->lot,
                'provenance' => $request->provenance,
            ]
        );

        if ($stock && $stock->dateExpiration == $request->dateExp) {
            Stock::where('idMedicament', $request->id)->update(
                [
                    'quantiteStock' => $stock->quantiteStock + $request->quantiteEntree,
                    'quantiteUnitaire' => ($stock->quantiteStock + $request->quantiteEntree) * $medicament->nombreParBoite,
                ]
            );
        } else {
            Stock::create(
                [
                    'idMedicament' => $medicament->id,
                    'dateExpiration' => $request->dateExp,
                    'quantiteStock' => $request->quantiteEntree,
                    'quantiteUnitaire' => $request->quantiteEntree * $medicament->nombreParBoite,
                ]
            );
        }

        Historique::create(
            [
                'idMedicament' => $request->id,
                'type' => 1,
            ]
        );
        return response()->json(['message' => 'Ajout entrér avec succes'], 200);
    }

    public function update(Request $request, $id)
    {
        $entree = Entree::where('id', $id)->first();
        $medicament = Medicament::where('id', $request->idM)->first();
        $stock = Stock::where('idMedicament', $request->idM)->first();
        Entree::where('id', $id)->update(
            [
                'quantiteEntree' => $request->quantiteEntree,
            ]
        );

        if ($entree) {
            $initial = $stock->quantitePlaquette - $entree->quantiteEntree;
            Stock::where('idMedicament', $request->idM)->update(
                [
                    'quantiteStock' => $initial + $request->quantiteEntree,
                    'quantiteUnitaire' => ($initial + $request->quantiteEntree) * $medicament->nombreParBoite,
                ]
            );
        }
        return response()->json(['message' => 'Modification avec succes'], 200);
    }


    public function destroy($id)
    {
        $entree = Entree::where('id', $id)->first();
        Entree::destroy($id);
        $medicament = Medicament::where('id', $entree->idMedicament)->first();
        $stock = Stock::where('idMedicament', $medicament->id)->first();
        Stock::where('idMedicament', $entree->idMedicament)
            ->update(
                [
                    'quantitePlaquette' => ($stock->quantitePlaquette - $entree->quantiteEntree),
                    'quantiteUnitaire' => $stock->quantiteUnitaire - $entree->quantiteEntree * $medicament->nombrePlaquette,
                ]
            );
        return response()->json(['message' => 'Suppression avec succes'], 200);
    }
}
