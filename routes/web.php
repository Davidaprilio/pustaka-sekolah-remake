<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EtalaseBookController;
use App\Http\Controllers\PustakaController;
use App\Http\Controllers\TaskController;
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

Route::view('/adminlte', 'starter');
Route::view('/try', 'trying');

Route::get('/', function () {
    return redirect('/semua-buku');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index');

    Route::prefix('panel')->group(function() {
        /*
        |================================================
        | Manage Book by Admin
        |================================================
        */
        Route::prefix('books')->controller(BookController::class)->group(function () {
            Route::get('/', 'index')->name('books.index');
            Route::get('create', 'create')->name('books.create');
            Route::post('create', 'upload_book_pdf')->name('books.upload');
            Route::put('create', 'store');
            Route::get('detail/{book}', 'index')->name('books.detail');
    
            Route::get('edit/{book:slug}', 'edit')->name('books.edit');
            Route::post('edit/{book:slug}', 'update');
            Route::delete('{book:slug}', 'delete')->name('books.delete');
        });
    });

    Route::prefix('kategori')->name('etalase')->group(function () {
        Route::get('/', [EtalaseBookController::class, 'index'])->name('.index');
        Route::post('/item', [EtalaseBookController::class, 'kategori_store'])->name('.item');
        Route::delete('/item/{etalaseBook:id}', [EtalaseBookController::class, 'kategori_delete'])->name('.item.delete');

        Route::post('/group', [EtalaseBookController::class, 'store_group'])->name('.group');
        Route::delete('/group/{etalaseGroup:id}', [EtalaseBookController::class, 'delete_group'])->name('.group.delete');
    });


    /*
    |================================================
    | Jika Mau meulai lagi dari sini
    |================================================
    | Selesaikan dulu fiture task sampai finish
    | - CRUD Task
    | - Task Date Range (jangka waktu dibuka)
    | - Task Report
    | - Task for Read Book
    | - Task set Disable Time - mode tanpa melemparkan user saat diam namun tetap di monit
    | - Task set Lock other Page
    |
    */
    Route::prefix('admin/task')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('task.list');

        Route::get('create', [PustakaController::class, 'baca']);
        Route::post('create', [PustakaController::class, 'baca']);

        Route::get('{task:id}/edit', [PustakaController::class, 'baca']);
        Route::post('{task:id}/edit', [PustakaController::class, 'baca']);

        Route::delete('{task:id}', [PustakaController::class, 'baca']);

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
