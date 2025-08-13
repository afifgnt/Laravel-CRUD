<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TabelController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/', [TabelController::class, 'index'])->name('index');
    Route::get('/create', [TabelController::class, 'create'])->name('create');
    Route::post('/', [TabelController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [TabelController::class, 'edit'])->name('edit');
    Route::put('/{id}', [TabelController::class, 'update'])->name('update');
    Route::delete('/{id}', [TabelController::class, 'destroy'])->name('destroy');
});