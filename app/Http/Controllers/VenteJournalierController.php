<?php

namespace App\Http\Controllers;

use App\Models\VenteJournalier;
use Illuminate\Http\Request;

class VenteJournalierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vente = VenteJournalier::join('medicaments', 'medicaments.id', '=', 'vente_journaliers.idMedicament')
        ->select(
            'vente_journaliers.*',
            'medicaments.id as idMedicament',
            'medicaments.denomination', 
            'medicaments.forme', 
            'medicaments.presentation',
        )->orderBy('id', 'desc')->get();
    return response()->json($vente, 200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VenteJournalier  $venteJournalier
     * @return \Illuminate\Http\Response
     */
    public function show(VenteJournalier $venteJournalier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VenteJournalier  $venteJournalier
     * @return \Illuminate\Http\Response
     */
    public function edit(VenteJournalier $venteJournalier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VenteJournalier  $venteJournalier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VenteJournalier $venteJournalier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VenteJournalier  $venteJournalier
     * @return \Illuminate\Http\Response
     */
    public function destroy(VenteJournalier $venteJournalier)
    {
        //
    }
}
