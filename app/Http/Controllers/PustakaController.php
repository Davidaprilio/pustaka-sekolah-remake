<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\EtalaseBook;
use App\Models\EtalaseGroup;
use App\Models\PivotEtalaseBook;
use App\Models\ReadSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PustakaController extends Controller
{
    /**
     * $state_page = Memeriksa segment ke-2, yang berisi informasi sedang di halaman List buku | Detail buku
     * $keyword = Kondisi jika ada pencarian akan meneruskan keyword pencarian ke-JS (WHERE Stack-nya | Rak Buku-nya)
     */
    public function index(Request $request)
    {
        $keyword = $request->search ?? null;
        $state_page = $request->segment(2) === null
            ? 'list'
            : 'detail';

        return view('pustaka.book-list', [
            'state_page' => $state_page,
            'keyword' => $keyword,
            'etalase_menu' => app('etalase_menu')
        ]);
    }

    public function books(Request $request)
    {
        $stack = $request->stack;
        $etalase_book = EtalaseBook::with(['books' => fn ($q) => $q->orderBy('created_at', 'DESC')])->withCount('books');
        if ($stack === 'semua-buku') {
            $etalase_book = $etalase_book->having('books_count', '>', 0)->orderBy('books_count', 'desc')->take(10)->get();
            $etalase_book->map(fn ($q) => $q->setRelation('books', $q->books->take(6)));
        } else {
            $etalase_book = $etalase_book->where('slug', $stack)->first();
            if ($etalase_book === null) {
                return view('pustaka.not-found');
            }
        }
        
        // dd($etalase_book, $stack);
        return view('pustaka.book-list', [
            'etalase_book' => $etalase_book,
            'is_ajax' => $request->ajax(),
        ]);
    }


    public function book(Request $request)
    {
        $book = Book::firstWhere('slug', $request->slug);

        return view('pustaka.detail-book', [
            'book' => $book,
            'is_ajax' => $request->ajax()
        ]);
    }


    /*
    |================================================
    | Handle Open and Read Book
    |================================================
    |
    */
    public function baca(Request $request, Book $book)
    {
        $read_sesi = ReadSession::where('book_id', $book->id)->where('user_id', $request->user()->id)->first();

        if (!$read_sesi) {
            $read_sesi = ReadSession::create([
                'user_id' => $request->user()->id,
                'book_id' => $book->id,
                'last_page' => 1,
                'current_page' => 1,
                'long_time' => 1,
                'history' => '[]',
                'on_reading' => 1,
                'percent_completed' => 0,
            ]);
        }

        return view('pustaka.book-reader-legacy', [
            'book' => $book,
            'user' => $request->user()
        ]);
    }

    /*
    |================================================
    | Update Reading Activity
    |================================================
    |
    */
    public function refresh_session_reading(Request $request, Book $book)
    {
        $read_sesi = ReadSession::where('book_id', $book->id)->where('user_id', $request->user()->id)->first();

        $read_sesi->update([
            'last_page' => max($read_sesi->last_page, $request->num_page),
            'current_page' => $request->num_page,
            'percent_completed' => intval(round(100 / $book->pages * $read_sesi->last_page))
        ]);
        
        return ['message' => 'OK'];
    }


    public function page(Book $book)
    {
        $searchedValue = 4;
        unset($book->files['6']);
        $arr = (array) $book->files;
        $neededObject = array_filter(
            $arr,
            function ($arr) use (&$searchedValue) {
                $hasil = array_search($searchedValue, $arr);
                return is_bool($hasil) ? false : true;
            }
        );

        return [
            'file' => key($neededObject)
        ];
    }
}
