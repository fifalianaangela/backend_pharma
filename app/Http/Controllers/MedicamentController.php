<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicamentController extends Controller
{
    public function index()
    {
        $medicament = Medicament::all();
        return response()->json($medicament);
    }

    public function store(Request $request)
    {
        $medicament = Medicament::where('denomination', $request->denomination)
            ->where('forme', $request->forme)->first();

        if (!$medicament) {
            Medicament::create(
                [
                    'denomination' => $request->denomination,
                    'forme' => $request->forme,
                    'presentation' => $request->presentation,
                    'coutUnitaire' => $request->coutUnitaire,
                    'prixVente' => $request->prixVente,
                    'nombrePlaquette' => $request->nombrePlaquette,
                    'nombreGraine' => $request->nombreGraine,
                    'dateExpiration' => $request->dateExpiration,
                ]
            );
            return response()->json('Medicament ajouté avec succèss');
        } elseif ($medicament && strtolower($medicament->forme) !== strtolower($request->forme)) {
            Medicament::create(
                [
                    'denomination' => $request->denomination,
                    'forme' => $request->forme,
                    'presentation' => $request->presentation,
                    'coutUnitaire' => $request->coutUnitaire,
                    'prixVente' => $request->prixVente,
                    'nombrePlaquette' => $request->nombrePlaquette,
                    'nombreGraine' => $request->nombreGraine,
                    'dateExpiration' => $request->dateExpiration,
                ]
            );
            return response()->json('Medicament ajouté avec succèss');
        } elseif ($medicament && strtolower($medicament->forme) === strtolower($request->forme)) {
            return response()->json('Medicament existe déjà dans la base de donnée');
        }
    }

    public function update($id, Request $request)
    {
        Medicament::where('id', $id)
            ->update([
                'denomination' => $request->denomination,
                'forme' => $request->forme,
                'presentation' => $request->presentation,
                'coutUnitaire' => $request->coutUnitaire,
                'prixVente' => $request->prixVente,
                'nombrePlaquette' => $request->nombrePlaquette,
                'dateExpiration' => $request->dateExpiration,
            ]);
    }

    public function destroy($id)
    {
        try {
            Medicament::destroy($id);
            return response()->json(['message' => 'Suppression avec succes']);
        } catch (\Exception $e) {
            // \Log::error($e->getMessage());
            return response()->json([
                'message' => 'Une erreur se produite lors de la suppression!!'
            ], 500);
        }
    }
}
