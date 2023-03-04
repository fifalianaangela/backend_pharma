<?php

use App\Http\Controllers\CommandeController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\MedicamentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/medicaments', [MedicamentController::class, 'index']);
Route::post('/medicaments', [MedicamentController::class, 'store']);
Route::put('/medicaments/{id}', [MedicamentController::class, 'update']);
Route::delete('/medicaments/{id}', [MedicamentController::class, 'destroy']);
Route::get('/fournisseurs', [FournisseurController::class, 'index']);
Route::post('/fournisseurs', [FournisseurController::class, 'store']);
Route::put('/fournisseurs/{id}', [FournisseurController::class, 'update']);
Route::delete('/fournisseurs/{id}', [FournisseurController::class, 'destroy']);
Route::get('/commandes', [CommandeController::class, 'index']);
Route::post('/commandes', [CommandeController::class, 'store']);
Route::put('/commandes/{id}', [CommandeController::class, 'update']);
Route::delete('/commandes/{id}', [CommandeController::class, 'destroy']);


