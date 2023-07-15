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

    public function store(Request $request)
    {
        Pharmacie::create(
            [
                'idMedicament' => $request->id,
                'quantitePharmacie' => $request->quantitePharmacie,
                'dateExpiration' => $request->dateExp,
            ]
        );
    }

    public function update(Request $request, Pharmacie $pharmacie)
    {
        //
    }

    public function destroy(Pharmacie $pharmacie)
    {
        //
    }
}
