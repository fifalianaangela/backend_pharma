<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicament = Medicament::all();
        return response()->json($medicament);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Medicament::create(
            [
                'codeProduit' => $request->codeProduit,
                'nomMedicament' => $request->nomMedicament,
                'quantite' => $request->quantite,
                'coutUnitaire' => $request->coutUnitaire,
                'prixVente' => $request->prixVente,
                'nombrePlaquette' => $request->nombrePlaquette
            ]
        );
        return response()->json('Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function show(Medicament $medicament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicament $medicament)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        DB::table('medicaments')
            ->where('id', $id)
            ->update([
                'codeProduit' => $request->codeProduit,
                'nomMedicament' => $request->nomMedicament,
                'coutUnitaire' => $request->coutUnitaire,
                'prixVente' => $request->prixVente,
                'nombrePlaquette' => $request->nombrePlaquette,
                'quantite' => $request->quantite
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::table('medicaments')->where("id", $id)->delete();
            return response()->json(['message' => 'Suppression avec succes']);
        } catch (\Exception $e) {
            // \Log::error($e->getMessage());
            return response()->json([
                'message' => 'Une erreur se produite lors de la suppression!!'
            ], 500);
        }
    }
}
