<?php

namespace App\Http\Controllers;

use App\Models\Pharmacie;
use Illuminate\Http\Request;

class PharmacieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmacie = Pharmacie::join('medicaments', 'medicaments.id', '=', 'pharmacies.idMedicament')
            // ->join('stocks', 'stocks.idMedicament', '=', 'pharmacies.idMedicament')
            ->select(
                'pharmacies.*',
                'medicaments.id as idMedicament',
                'medicaments.denomination',
                'medicaments.nombreParBoite',
                'medicaments.presentation',
                'medicaments.forme',
            )->orderBy('id', 'desc')->get();
        return response()->json($pharmacie);
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
     * @param  \App\Models\Pharmacie  $pharmacie
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmacie $pharmacie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pharmacie  $pharmacie
     * @return \Illuminate\Http\Response
     */
    public function edit(Pharmacie $pharmacie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pharmacie  $pharmacie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pharmacie $pharmacie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pharmacie  $pharmacie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pharmacie $pharmacie)
    {
        //
    }
}
