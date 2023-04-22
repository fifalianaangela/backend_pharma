<?php

namespace App\Http\Controllers;
use App\Models\MedicamentTriggers;

use Illuminate\Http\Request;

class TriggersController extends Controller
{
    public function index()
    {
        $triggers = MedicamentTriggers::all();
        return response()->json($triggers);
    }
}
