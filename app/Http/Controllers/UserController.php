<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }

    public function update($id, Request $request)
    {
        User::where('id', $id)
            ->update([
                'role' => $request->role,
                'isAdmin' => $request->type,
            ]);
        return response()->json(['message' => 'Modification avec succes'], 200);
    }
}
