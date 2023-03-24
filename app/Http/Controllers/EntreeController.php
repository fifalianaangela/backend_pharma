<?php

namespace App\Http\Controllers;

use App\Models\Entree;
use App\Models\Historique;
use App\Models\Medicament;
use Illuminate\Http\Request;

class EntreeController extends Controller
{
    public function index()
    {
        $entree = Entree::join('medicaments', 'medicaments.id', '=', 'entrees.idMedicament')
            ->get();
        return response()->json($entree);
    }

    public function store(Request $request)
    {
        $entree = Entree::where('idMedicament', $request->id)->first();
        $medicament = Medicament::where('id', $request->id)->first();
        if ($entree) {
            Entree::where('idMedicament', $request->id)
                ->update(
                    [
                        'stock' => $entree->stock + $request->quantiteEntree,
                        'dernierEntree' => $request->quantiteEntree,
                        'dateDernierEntree' => $request->formattedDate,
                        'nombrePlaquetteEntree' => $entree->nombrePlaquetteEntree + $request->quantiteEntree * $medicament->nombrePlaquette,
                        'nombreGraineEntree' => $entree->nombreGraineEntree + $medicament->nombrePlaquette * $medicament->nombreGraine * $request->quantiteEntree,
                    ]
                );
        } elseif (!$entree) {
            Entree::create(
                [
                    'idMedicament' => $request->id,
                    'stock' => $request->quantiteEntree,
                    'dernierEntree' => $request->quantiteEntree,
                    'dateDernierEntree' => $request->formattedDate,
                    'nombrePlaquetteEntree' => $request->quantiteEntree * $medicament->nombrePlaquette,
                    'nombreGraineEntree' => $request->quantiteEntree * $medicament->nombrePlaquette * $medicament->nombreGraine,
                ]
            );
        }
        Historique::create(
            [
                'idMedicament' => $request->id,
                'type' => 1,
                'provDest' => $request->provenance,
                'quantiteEntree' => $request->quantiteEntree,
                'lot' => $request->lot,
                'observation' => $request->observation,
                'date' => $request->formattedDate,
            ]
        );
        return response()->json('Ajout d\'entree avec succès');
    }

    public function update(Request $request, $id)
    {
        $entree = Entree::where('idMedicament', $id)->first();
        $medicament = Medicament::where('id', $id)->first();
        if ($entree->dernierEntree < $request->quantiteEntree) {
            $entreeUpdate = $request->quantiteEntree - $entree->dernierEntree; //difference entre dernier et nouveau modif
            Entree::where('idMedicament', $id)
                ->update(
                    [
                        'dernierEntree' => $request->quantiteEntree,
                        'stock' => $entree->stock + $entreeUpdate,
                        'nombrePlaquetteEntree' => $entree->stock * $medicament->nombrePlaquette + $entreeUpdate * $medicament->nombrePlaquette,
                        'nombreGraineEntree' => $entree->stock * $medicament->nombrePlaquette * $medicament->nombreGraine + $entreeUpdate * $medicament->nombrePlaquette * $medicament->nombreGraine,
                    ]
                );
        } elseif ($entree->dernierEntree > $request->quantiteEntree) {
            $diff = $entree->dernierEntree - $request->quantiteEntree; //difference entre dernier et nouveau modif
            $stock = $entree->stock - $diff; //total en stock avant modification
            Entree::where('idMedicament', $id)
                ->update(
                    [
                        'dernierEntree' => $request->quantiteEntree,
                        'stock' => $stock,
                        'nombrePlaquetteEntree' => $stock * $medicament->nombrePlaquette,
                        'nombreGraineEntree' => $stock * $medicament->nombrePlaquette * $medicament->nombreGraine,
                    ]
                );
        } else {
            return response()->json("Rien à modifier!!");
        }
        return response()->json('Modification avec succèss');
    }
    public function destroy($id)
    {
        Entree::destroy($id);
        return response()->json("Suppresion d'entrée avec succèss");
    }
}
