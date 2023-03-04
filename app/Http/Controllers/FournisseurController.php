<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseur = Fournisseur::all();
        return response()->json($fournisseur);
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
        Fournisseur::create(
            [
                'nomFournisseur' => $request->nomFournisseur,
                'adresseFournisseur' => $request->adresseFournisseur,
                'telephoneFournisseur' => $request->telephoneFournisseur,
                'mailFournisseur' => $request->mailFournisseur,

            ]
        );
        return response()->json('Succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('fournisseurs')
            ->where('id', $id)
            ->update(
                [
                    'nomFournisseur' => $request->nomFournisseur,
                    'adresseFournisseur' => $request->adresse,
                    'telephoneFournisseur' => $request->telephone,
                    'mailFournisseur' => $request->mail,
                ]

            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::table('fournisseurs')->where("id", $id)->delete();
            return response()->json(['message'=>'Suppression avec succes']);
        }
        
        catch (\Exception $e) {
            // \Log::error($e->getMessage());
            return response()->json([
                'message' => 'Une erreur se produite lors de la suppression!!'
            ], 500);
        }
    }
}
