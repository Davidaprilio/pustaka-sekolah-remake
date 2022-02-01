<?php

use App\Http\Controllers\PustakaController;
use App\Http\Livewire as Wire;
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
    return redirect('/semua-buku');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('dashboard', Wire\Book\Show::class)->name('dashboard');

    Route::get('books', Wire\Book\Show::class)->name('book.index');
    Route::get('pustaka/aktivitas', Wire\Activity\Show::class)->name('pustaka.activity');
    Route::get('etalase', Wire\Stack\Show::class)->name('etalase-stack');
});

Route::get('json/pustaka/etalase/{stack}', [PustakaController::class, 'books']);
Route::get('json/pustaka/book/{slug}', [PustakaController::class, 'book']);

Route::get('books/{book:slug}', [PustakaController::class, 'baca']);
Route::get('baca/buku/{book:slug}', [PustakaController::class, 'baca']);
Route::get('reading/book/action/{book:slug}/{num}', [PustakaController::class, 'refreshSessionReading']);
Route::get('/{stack}', [PustakaController::class, 'index']);
