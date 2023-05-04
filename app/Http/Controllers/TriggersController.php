<?php

namespace App\Http\Controllers;

use App\Models\MedicamentTriggers;
use App\Models\EntreeTriggers;

use Illuminate\Http\Request;

class TriggersController extends Controller
{
    public function index()
    {
        $triggers = MedicamentTriggers::join('users', 'users.id', '=', 'medicament_triggers.userId')
            ->select(
                'medicament_triggers.*',
                'users.email',
                'users.name', 
            )
            ->get();
        return response()->json($triggers);
    }
    public function index1()
    {
        $triggers = EntreeTriggers::all();
        return response()->json($triggers);
    }
}
