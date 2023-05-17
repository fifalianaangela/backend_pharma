<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $medicament = Medicament::where('denomination', $request->denomination . " " . $request->dosage)
            ->where('forme', $request->forme)->first();

        if (!$medicament) {
            Medicament::create(
                [
                    'denomination' => $request->denomination . " " . $request->dosage,
                    'forme' => $request->forme,
                    'presentation' => $request->presentation,
                    'prixVente' => $request->prixVente,
                    'nombreParBoite' => $request->nombreParBoite,
                    'userId' => $request->userId,
                ]
            );
            return response()->json(['message' => 'Medicament ajouté avec succèss'], 200);
        } elseif ($medicament && strtolower($medicament->forme) !== strtolower($request->forme)) {
            Medicament::create(
                [
                    'denomination' => $request->denomination . " " . $request->dosage,
                    'forme' => $request->forme,
                    'presentation' => $request->presentation,
                    'prixVente' => $request->prixVente,
                    'nombreParBoite' => $request->nombreParBoite,
                    'userId' => $request->userId,
                ]
            );
            return response()->json('Medicament ajouté avec succèss');
        } elseif ($medicament && strtolower($medicament->forme) === strtolower($request->forme)) {
            return response()->json(['message' => 'Medicament existe déjà dans la base de donnée'], 200);
        }
    }

    public function update($id, Request $request)
    {
        Medicament::where('id', $id)
            ->update([
                'denomination' => $request->denomination." ".$request->dosage,
                'forme' => $request->forme,
                'presentation' => $request->presentation,
                'prixVente' => $request->prixVente,
                'nombreParBoite' => $request->nombreParBoite,
            ]);
        return response()->json(['message' => 'Modification avec succes'], 200);
    }

    public function destroy($id)
    {
        try {
            Medicament::destroy($id);
            return response()->json(['message' => 'Suppression avec succes'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Une erreur se produite lors de la suppression!!'
            ], 500);
        }
    }
}
