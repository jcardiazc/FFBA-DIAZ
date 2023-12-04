<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\AdminFilmController;

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
    return view('hello');
});

Route::get('/index', [FilmController::class, 'index']);

Route::get('/film/{id}', [FilmController::class, 'film']);

Route::get('/fetch-store-films', [FilmController::class, 'fetchStoreFilms']);


Route::get('/admin/films/index', [AdminFilmController::class, 'index']);

Route::resource('admin/films', AdminFilmController::class);

Route::delete('admin/films/{film}', [AdminFilmController::class, 'destroy'])->name('admin.films.destroy');

