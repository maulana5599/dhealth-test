<?php

use App\Http\Controllers\MasterObatController;
use App\Http\Controllers\MasterSignaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('dhealth')->group( function () {
    Route::get('obat', [MasterObatController::class, 'index'])->name('MasterObat');
    Route::get('data_obat', [MasterObatController::class, 'DataObat'])->name('DataObat');
    Route::get('signa', [MasterSignaController::class, 'index'])->name('MasterSigna');

});
