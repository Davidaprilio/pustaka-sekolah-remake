<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\EtalaseBook;
use App\Models\EtalaseGroup;
use App\Models\PivotEtalaseBook;
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
        $etalase = EtalaseGroup::all();
        $etalase->load('etalase');
        $menu_etalase = [];
        foreach ($etalase as $value) {
            array_push($menu_etalase, [
                'name' => $value->name,
                'slug' => $value->slug,
                'stack' => Arr::pluck($value->etalase, 'slug', 'name')
            ]);
        }
        return view('pustaka.index', [
            'state_page' => $state_page,
            'keyword' => $keyword,
            'etalase_menu' => $menu_etalase
        ]);
    }

    public function books(Request $request)
    {
        $stack = $request->segment(4);
        if ($stack === 'semua-buku') {
            $etalase_book = EtalaseBook::all();
        } else {
            $etalase_book = EtalaseBook::firstWhere('slug', $stack);
        }
        if ($etalase_book) $etalase_book->load('books');

        return view('pustaka.list-book', [
            'etalase_book' => $etalase_book
        ]);
    }


    public function book(Request $request)
    {
        $book = Book::firstWhere('slug', $request->slug);

        return view('pustaka.detail-book', [
            'book' => $book
        ]);
    }


    public function baca(Request $request, $book)
    {
        return view('pustaka.book-reader-legacy', [
            'book' => 'ocsiufcnhsehfu',
            'user' => $request->user()
        ]);
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