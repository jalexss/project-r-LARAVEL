<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecetaController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('recetas')->middleware('auth')->group(function() {
    Route::get('/', [RecetaController::class, 'index'])
        ->name('recetas.index');

    Route::get('/create', [RecetaController::class, 'create'])
        ->name('recetas.create');
    
    Route::get('/edit/{id}', [RecetaController::class, 'edit'])
        ->name('recetas.edit');
    
    Route::get('/{id}', [RecetaController::class, 'show'])
        ->name('recetas.show');

    Route::post('/', [RecetaController::class, 'store'])
        ->name('recetas.store');
    
    Route::put('/{id}', [RecetaController::class, 'update'])
        ->name('recetas.update');

    Route::delete('/{id}', [RecetaController::class, 'destroy'])
        ->name('recetas.destroy');

    Route::get('/{id}/images', [RecetaController::class, 'editImages'])
        ->name('recetas.images');

    Route::patch('/{id}/images', [RecetaController::class, 'updateImages'])
        ->name('recetas.updateImages');
});