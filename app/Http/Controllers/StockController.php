<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $sortie = Stock::join('medicaments', 'medicaments.id', '=', 'stocks.idMedicament')
            ->select(
                'stocks.*',
                'medicaments.id as idMedicament',
                'medicaments.denomination',
                'medicaments.presentation',
                'medicaments.forme',
                'medicaments.unite',
            )->orderBy('id', 'desc')->get();
        return response()->json($sortie, 200);
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Stock $stock)
    {
        //
    }

    public function destroy(Stock $stock)
    {
        //
    }
}
