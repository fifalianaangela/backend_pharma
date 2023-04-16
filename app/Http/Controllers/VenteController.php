<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use App\Models\Pharmacie;
use App\Models\Vente;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    public function index()
    {
        $vente = Vente::join('medicaments', 'medicaments.id', '=', 'ventes.idMedicament')
            ->select(
                'ventes.*',
                'medicaments.id as idMedicament',
                'medicaments.denomination',
                'medicaments.presentation',
                'medicaments.forme',
                'medicaments.prixVente',
            )->orderBy('id', 'desc')->get();
        return response()->json($vente, 200);
    }


    public function store(Request $request)
    {
        $medicament = Medicament::where('id', $request->idMedicament)->first();
        $pharmacie = Pharmacie::where('idMedicament', $request->idMedicament)
            ->where('dateExpiration', $request->dateExpiration)->first();
        Vente::create([
            'idMedicament' => $request->idMedicament,
            'dateExpiration' => $request->dateExpiration,
            'quantiteVendu' => $request->quantiteVente,
            'acheteur' => $request->acheteur,
            'dateVente' => $request->formattedDate,
            'prixTotal' => $request->quantiteVente * $medicament->prixVente,
        ]);

        Pharmacie::where('idMedicament', $request->idMedicament)
            ->where('dateExpiration', $request->dateExpiration)
            ->update([
                'quantitePharmacie' => $pharmacie->quantitePharmacie - $request->quantiteVente
            ]);

        return response()->json(['message' => 'Vendu avec succèss'], 200);
    }

    public function update(Request $request, $id)
    {
        $vente = Vente::where('id', $id)->first();
        $medicament = Medicament::where('id', $vente->idMedicament)->first();
        $pharmacie = Pharmacie::where('idMedicament', $vente->idMedicament)
            ->where('dateExpiration', $vente->dateExpiration)->first();
        $initial = $pharmacie->quantitePharmacie + $vente->quantiteVendu;
        Vente::where('id', $id)
            ->update(
                [
                    'quantiteVendu' => $request->quantiteVendu,
                    'acheteur' => $request->acheteur,
                    'prixTotal' => $request->quantiteVendu * $medicament->prixVente
                ]
            );
        Pharmacie::where('idMedicament', $vente->idMedicament)
            ->where('dateExpiration', $vente->dateExpiration)
            ->update([
                'quantitePharmacie' => $initial - $request->quantiteVendu
            ]);

        return response()->json(['message' => 'Modification de vente avec success'], 200);
    }

    public function destroy(Vente $vente)
    {
        //
    }
}
