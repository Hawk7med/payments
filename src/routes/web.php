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

use App\Http\Controllers\ZoneController;
use App\Http\Controllers\ImmeubleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppartementController;


Route::get('/', function () {
    return view('welcome');
});
Route::resource('zones', ZoneController::class);
Route::resource('immeubles', ImmeubleController::class);
Route::resource('appartements', AppartementController::class);
Route::resource('clients', ClientController::class);

Route::get('zones/{zone}/immeubles', [ZoneController::class, 'getImmeubles']);
Route::get('immeubles/{immeuble}/appartements', [ImmeubleController::class, 'getAppartements']);

