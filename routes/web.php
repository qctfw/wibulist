<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TopAnimeController;
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

Route::view('/', 'index')->name('index');

Route::group(['as' => 'anime.', 'prefix' => 'anime'], function () {
    Route::get('/', [AnimeController::class, 'index'])->name('index');
    
    Route::group(['as' => 'top.', 'prefix' => 'top'], function () {
        Route::get('rated', [TopAnimeController::class, 'rated'])->name('rated');
        Route::get('airing', [TopAnimeController::class, 'airing'])->name('airing');
        Route::get('popular', [TopAnimeController::class, 'popular'])->name('popular');
        Route::get('upcoming', [TopAnimeController::class, 'upcoming'])->name('upcoming');
        // Route::get('tv');
        // Route::get('movies');
    });

    Route::get('/season', [AnimeController::class, 'season'])->name('season-current');
    Route::get('/season/{year}/{season}', [AnimeController::class, 'season'])->name('season')->whereNumber('year')->where('season', '[a-z]+');

    Route::get('/genre', [GenreController::class, 'index'])->name('genre');
    Route::get('/genre/{slug}', [GenreController::class, 'show'])->name('genre.show');

    Route::get('{id}', [AnimeController::class, 'show'])->name('show')->whereNumber('id');
});
