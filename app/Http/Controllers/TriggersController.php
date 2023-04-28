<?php

namespace App\Http\Controllers;
use App\Models\MedicamentTriggers;
use App\Models\EntreeTriggers;

use Illuminate\Http\Request;

class TriggersController extends Controller
{
    public function index()
    {
        $triggers = MedicamentTriggers::all();
        return response()->json($triggers);
    }
    public function index1()
    {
        $triggers = EntreeTriggers::all();
        return response()->json($triggers);
    }
}
