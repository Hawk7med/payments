<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\ImmeubleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppartementController;
use App\Http\Controllers\ClientAppartementController;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin routes
});

Route::resource('zones', ZoneController::class);
Route::resource('immeubles', ImmeubleController::class);
Route::resource('appartements', AppartementController::class);
Route::resource('clients', ClientController::class);

Route::get('zones/{zone}/immeubles', [ZoneController::class, 'getImmeubles']);
Route::get('immeubles/{immeuble}/appartements', [ImmeubleController::class, 'getAppartements']);

Route::get('clients/{id}', [ClientController::class, 'show'])->name('clients.show');
Route::post('clients/{id}/add-appartement', [ClientController::class, 'addAppartement'])->name('clients.addAppartement');

Route::get('/client-appartements/create/{client}/{appartement_id}', [ClientAppartementController::class, 'create'])
    ->name('client-appartements.create');
    Route::post('/client-appartements', [ClientAppartementController::class, 'store'])
    ->name('client-appartements.store');

    // Route pour obtenir les immeubles en fonction de la zone
Route::get('/zones/{zone}/immeubles', [ImmeubleController::class, 'getImmeubles'])
->name('zones.immeubles');

// Route pour obtenir les appartements en fonction de l'immeuble
Route::get('/immeubles/{immeuble}/appartements', [AppartementController::class, 'getAppartements'])
->name('immeubles.appartements');

// Route pour afficher le formulaire d'ajout d'appartement
Route::get('/client-appartements/create/{client}', [ClientAppartementController::class, 'create'])
->name('client-appartements.create');

// Route pour stocker le nouvel appartement
Route::post('/client-appartements', [ClientAppartementController::class, 'store'])
->name('client-appartements.store');

Route::get('/client-appartements/{id}/details', [ClientAppartementController::class, 'details'])->name('client-appartements.details');
Route::post('/client-appartements/{id}/payments', [ClientAppartementController::class, 'savePayment'])->name('client-appartements.savePayment');

Route::post('/client-appartements/{clientAppartementId}/payments', [ClientAppartementController::class, 'storePayment'])->name('client-appartements.store-payment');

Route::post('/client-appartements/update-payments', [ClientAppartementController::class, 'updatePayments'])->name('client-appartements.update-payments');

Route::put('/client-appartements/{id}/update-paper', [ClientAppartementController::class, 'updatePaper'])->name('client-appartements.update-paper');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('appartements', AppartementController::class);
Route::get('appartements/not-paid/{year}', [AppartementController::class, 'notPaid'])->name('appartements.notPaid');