<?php

use App\Http\Controllers\MasterObatController;
use App\Http\Controllers\MasterSignaController;
use App\Http\Controllers\TransaksiResepController;
use App\Models\TransaksiJumlah;
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
    return view('pages.landing');
});



Route::prefix('dhealth')->group( function () {
    
    //Master obat
    Route::get('obat', [MasterObatController::class, 'index'])->name('MasterObat');
    Route::get('data_obat', [MasterObatController::class, 'DataObat'])->name('DataObat');
    Route::get('all_obat', [MasterObatController::class, 'AllObat'])->name('AllObat');

    // Master Signa
    Route::get('signa', [MasterSignaController::class, 'index'])->name('MasterSigna');
    Route::get('data_signa', [MasterSignaController::class, 'DataSigna'])->name('DataSigna');
    Route::get('all_signa', [MasterSignaController::class, 'AllSigna'])->name('AllSigna');

    // Transaksi Resep

    Route::get('resep', [TransaksiResepController::class, 'index'])->name('TransaksiResep');
    Route::get('page/{page}', [TransaksiResepController::class, 'GetPage'])->name('ViewPage');
    Route::post('resep', [TransaksiResepController::class, 'save'])->name('SimpanResep');
    Route::post('resep-non', [TransaksiResepController::class, 'SaveNonRacikan'])->name('SimpanResepNon');
    Route::get('data_resep', [TransaksiResepController::class, 'DataResep'])->name('DataResep');

});
