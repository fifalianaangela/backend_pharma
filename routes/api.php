<?php

use App\Http\Controllers\CommandeController;
use App\Http\Controllers\EntreeController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\PharmacieController;
use App\Http\Controllers\SortieController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\TriggersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenteJournalierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// route for medicaments
Route::get('/medicaments', [MedicamentController::class, 'index']);
Route::post('/medicaments', [MedicamentController::class, 'store']);
Route::put('/medicaments/{id}', [MedicamentController::class, 'update']);
Route::delete('/medicaments/{id}', [MedicamentController::class, 'destroy']);

// route for fournisseurs
Route::get('/fournisseurs', [FournisseurController::class, 'index']);
Route::post('/fournisseurs', [FournisseurController::class, 'store']);
Route::put('/fournisseurs/{id}', [FournisseurController::class, 'update']);
Route::delete('/fournisseurs/{id}', [FournisseurController::class, 'destroy']);

// route for commandes
Route::get('/commandes', [CommandeController::class, 'index']);
Route::post('/commandes', [CommandeController::class, 'store']);
Route::put('/commandes/{id}', [CommandeController::class, 'update']);
Route::delete('/commandes/{id}', [CommandeController::class, 'destroy']);

// route for entrees
Route::get('/entrees', [EntreeController::class, 'index']);
Route::post('/entrees', [EntreeController::class, 'store']);
Route::put('/entrees/{id}', [EntreeController::class, 'update']);
Route::delete('/entrees/{id}', [EntreeController::class, 'destroy']);

// route for sorties
Route::get('/sorties', [SortieController::class, 'index']);
Route::post('/sorties', [SortieController::class, 'store']);
Route::put('/sorties/{id}', [SortieController::class, 'update']);
Route::delete('/sorties/{id}', [SortieController::class, 'destroy']);

// route for historiques
Route::get('/historiques', [HistoriqueController::class, 'index']);

// route for stocks
Route::get('/stocks', [StockController::class, 'index']);

// route for pharmacies
Route::get('/pharmacies', [PharmacieController::class, 'index']);

// route for ventes
Route::get('/ventes', [VenteController::class, 'index']);
Route::post('/ventes', [VenteController::class, 'store']);
Route::put('/ventes/{id}', [VenteController::class, 'update']);

// route for venteJournalier
Route::get('/venteJournalier', [VenteJournalierController::class, 'index']);

// route for trigger
Route::get('/triggers', [TriggersController::class, 'index']);

// route for user
Route::get('/users', [UserController::class, 'index']);
Route::put('/users/{id}', [UserController::class, 'update']);

//route for auth
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('register', [LoginController::class, 'register']);
