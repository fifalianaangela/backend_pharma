<?php

namespace App\Http\Controllers;

use App\Models\Entree;
use App\Models\Historique;
use App\Models\Medicament;
use App\Models\Sortie;
use Illuminate\Http\Request;

class SortieController extends Controller
{
    public function index()
    {
        $sortie = Sortie::join('medicaments', 'medicaments.id', '=', 'sorties.idMedicament')
            ->get();
        return response()->json($sortie);
    }

    public function store(Request $request)
    {
        $sortie = Sortie::where('idMedicament', $request->id)->first();
        $entree = Entree::where('idMedicament', $request->id)->first();
        $medicament = Medicament::where('id', $request->id)->first();
        Sortie::create(
            [
                'idMedicament' => $request->id,
                'stock' => $entree->nombreGraineEntree - $request->quantiteSortie,
                'nombreSortie' => $request->quantiteSortie,
                'dernierSortie' => $request->quantiteSortie,
                'dateSortie' => $request->formattedDate,
            ]
        );

        Historique::create(
            [
                'idMedicament' => $request->id,
                'type' => 0,
                'provDest' => $request->destination,
                'quantiteSortie' => $request->quantiteSortie,
                'lot' => $request->lot,
                'observation' => $request->observation,
                'date' => $request->formattedDate,
            ]
        );
        return response()->json('Sortie avec succèss');
    }

    public function update(Request $request, Sortie $sortie)
    {
        //
    }

    public function destroy(Sortie $sortie)
    {
        //
    }
}
