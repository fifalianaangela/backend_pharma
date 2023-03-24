<?php

namespace App\Http\Controllers;

use App\Models\Historique;

class HistoriqueController extends Controller
{

    public function index()
    {
        $historiques = Historique::join('medicaments', 'medicaments.id', '=', 'historiques.idMedicament')
        ->select(
                'historiques.*',
                'medicaments.id as idMedicament',
                'medicaments.denomination',
                'medicaments.dateExpiration',
                'medicaments.forme',
                'medicaments.presentation',
            )->get();
        return response()->json($historiques);
    }
}
