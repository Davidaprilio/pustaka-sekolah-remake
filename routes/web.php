<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\EtalaseBookController;
use App\Http\Controllers\PustakaController;
// use App\Http\Livewire as Wire;
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

Route::view('/try', 'trying');

Route::get('/', function () {
    return redirect('/semua-buku');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard');

    Route::prefix('books')->name('books')->group(function () {
        Route::get('/', [BookController::class, 'index']);
        Route::get('create', [BookController::class, 'create'])->name('.create');
        Route::post('create', [BookController::class, 'upload_book_pdf']);
        Route::put('create', [BookController::class, 'store']);
        Route::get('detail/{book}', [BookController::class, 'index'])->name('.detail');

        Route::get('edit/{book:slug}', [BookController::class, 'edit'])->name('.edit');
        Route::post('edit/{book:slug}', [BookController::class, 'update']);
        Route::delete('{book:slug}', [BookController::class, 'delete'])->name('.delete');
    });

    Route::prefix('kategori')->name('etalase')->group(function () {
        Route::get('/', [EtalaseBookController::class, 'index'])->name('.index');
        Route::post('/item', [EtalaseBookController::class, 'kategori_store'])->name('.item');
        Route::delete('/item/{etalaseBook:id}', [EtalaseBookController::class, 'kategori_delete'])->name('.item.delete');

        Route::post('/group', [EtalaseBookController::class, 'store_group'])->name('.group');
        Route::delete('/group/{etalaseGroup:id}', [EtalaseBookController::class, 'delete_group'])->name('.group.delete');
    });



    // Route::get('pustaka/aktivitas', Wire\Activity\Show::class)->name('pustaka.activity');
    // Route::get('etalase', Wire\Stack\Show::class)->name('etalase-stack');

    
    // Route for reading book V1
    Route::get('reading/book/action/{book:slug}/{num_page}', [PustakaController::class, 'refresh_session_reading']);
    Route::get('baca/buku/{book:slug}', [PustakaController::class, 'baca']);

    /*
    |================================================
    | Route for reading book v2
    |================================================
    */
    Route::prefix('read/book')->controller(PustakaController::class)->group(function() {
        Route::post('/action/{book:slug}/{num_page}', 'refresh_session_reading');
        Route::get('/{book:slug}', 'baca');
    });

});

Route::get('books/{book:slug}', [PustakaController::class, 'baca']);

Route::get('json/pustaka/etalase/{stack}', [PustakaController::class, 'books']);
Route::get('json/pustaka/book/{slug}', [PustakaController::class, 'book']);

Route::get('/{stack}', [PustakaController::class, 'books']);
Route::get('/{stack}/{slug}', [PustakaController::class, 'book']);
