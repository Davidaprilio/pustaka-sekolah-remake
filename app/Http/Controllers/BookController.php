<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $books = Book::orderBy('created_at', 'DESC');
            return DataTables::of($books)->toJson();
        }
        return view('books.index');
    }

    public function create()
    {
        return view('books.create', []);
    }

    public function edit(Book $book)
    {
        // userHasRole('admin')

        return view('books.edit', [
            'book' => $book
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $book->update([
            'title' => $request->title,
            'description' => $request->desc,
            'publisher' => $request->publisher,
            'writer' => $request->writer,
        ]);

        return redirect()->route('books.edit', $book->slug)->with('success', 'Buku berhasil disimpan');
    }

    public function upload_book_pdf(Request $request)
    {
        $request->validate([
            'file_book' => 'required|mimes:pdf',
            'cover_book' => 'required'
        ]);
        $file_book = $request->file('file_book');

        // get strean file_book
        $stream = fopen($file_book, 'r+');
        $pdf = new Fpdi();
        try {
            $page_count = $pdf->setSourceFile($stream);
        } catch (\Throwable $th) {
            if ($th->getCode() == 268) {
                return redirect()->back()->withErrors(['file_book' => 'File PDF tidak bisa di upload karena file PDF terenkripsi (terdapat password)']);
            }
            return redirect()->back()->withErrors(['file_book' => 'File PDF tidak bisa diproses karena terjadi kesalahan']);
        }

        $book_title = $file_book->getClientOriginalName();
        $book_slug = str_slug($book_title);
        if ($duplicate_book = Book::firstWhere('slug', $book_slug)) {
            return redirect()->back()->withErrors([
                'file_book' => 'File PDF sudah pernah di upload sebelumnya dengan judul ' . $duplicate_book->title,
                'dublicate_book' => $duplicate_book->slug
            ]);
        }

        $cover = Image::make($request->cover_book);
        $cover->resize(200, null, fn ($constraint) => $constraint->aspectRatio());
        $path_cover = "public/cover.webp";
        $cover->save(storage_path('app/'.$path_cover));
        $path_cover = storage_url($path_cover);

        // $book_info['cover'] = $cover;
        $book_path = $file_book->store('public/books');
        $book_path = storage_url($book_path);
        
        $book_info = [
            'slug' => $book_slug,
            'title' => $book_title,
            'pages' => $page_count, 
            'download' => 0,
            'read' => 0,
            'publish' => 0,
            'files' => '[]',
            'cover' => $path_cover,
            'user_id' => Auth::id(),
            'path' => $book_path,
        ];

        $book = Book::create($book_info);
        
        return redirect()->route('books.edit', [
            'book' => $book->slug
        ])->with('success', 'Buku berhasil di upload');
    }

    static function split_pdf(string $storepath)
    {
        Storage::deleteDirectory("livewire-tmp");
        $data = ['files' => []];
        $pathFile = storage_path("app/{$storepath}");
        $filename = pathinfo($pathFile, PATHINFO_FILENAME);
        $data['path'] = $filename;
        $path_books = storage_path("app/public/book/{$filename}");
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($pathFile);
        $data['pages'] = $pageCount;
        $pdf->close();
        Storage::makeDirectory("public/book/{$filename}");

        $page_arr = [];

        // Split each page into a new PDF
        for ($a = 1; $a <= $pageCount; $a++) {
            $newPdf = new Fpdi();
            $newPdf->setSourceFile($pathFile);

            $templateId = $newPdf->importPage($a);
            $sizePage = $newPdf->getTemplateSize($templateId);
            $newPdf->AddPage($sizePage['orientation'], [
                $sizePage['width'],
                $sizePage['height']
            ]);
            $newPdf->useTemplate($templateId);
            $storage_path = "{$path_books}/{$a}.pdf";
            $newPdf->output($storage_path, 'F');
            $newPdf->close();
        }
        Storage::delete($storepath);
        return $data;
    }

    public function delete(Book $book)
    {
        $book->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus');
    }
}
