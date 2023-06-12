<?php

namespace App\Http\Controllers;

use App\Models\VenteJournalier;
use Illuminate\Http\Request;

class VenteJournalierController extends Controller
{
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

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, VenteJournalier $venteJournalier)
    {
        //
    }


    public function destroy(VenteJournalier $venteJournalier)
    {
        //
    }
}
