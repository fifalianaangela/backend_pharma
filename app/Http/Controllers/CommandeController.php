<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commande= Commande::all();
        return response()->json($commande);
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
        Commande::create(
           [ 
            "idMedicament"=>$request->idMedicament,
            "idFournisseur"=>$request->idFournisseur,
            "quantite"=>$request->quantite,
            "dateCommande"=>$request->dateCommande,
            "dateLivraison"=>$request->dateLivraison,
            "montantCommande"=>$request->montantCommande,
           ]
           );
           return response()->json('Succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('commandes')
        ->where('id', $id)
        ->update([
            "idMedicament"=>$request->idMedicament,
            "idFournisseur"=>$request->idFournisseur,
            "quantite"=>$request->quantiteCommande,
            "dateCommande"=>$request->dateCommande,
            "dateLivraison"=>$request->dateLivraison,
            "montantCommande"=>$request->montantCommande
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande, $id)
    {
        try {
            DB::table('commandes')->where("id", $id)->delete();
            return response()->json(['message' => 'Suppression avec succes']);
        } catch (\Exception $e) {
            // \Log::error($e->getMessage());
            return response()->json([
                'message' => 'Une erreur se produite lors de la suppression!!'
            ], 500);
        }
    }
}
