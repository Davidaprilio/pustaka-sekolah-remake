<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;
use Imagick;

class BookController extends Controller
{

    public function create()
    {
        return view('book.create', []);
    }

    public function store(Request $request)
    {
        $$im = new Imagick();
        $im->setResolution(300, 300);
        $im->readImage("test.pdf");
        $im->writeImage(public_path('/'));
        header('Content-Type: image/jpeg');
        echo $im;
        return true;
        $file_book = $request->file('book');
        // dd($file_book);
        self::split_pdf('test.pdf');
    }


    /**
     * Membagi File PDF per-halaman 
     * Menjadi File PDF baru
     */
    static function split_pdf(string $filename)
    {
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($filename);
        $file = pathinfo($filename, PATHINFO_FILENAME);
        $path = "book/{$file}";
        $pdf->AddPage();

        Storage::makeDirectory($path);
        $pathFile = storage_path("app/{$path}");
        // Split each page into a new PDF
        $newPdf = new Fpdi();
        $newPdf->setSourceFile($filename);

        $split = 4;
        $on_page = 1;
        for ($i = 1; $i <= ($pageCount / $split); $i++) {
            $last_page = 0;
            for ($a = $on_page; $a <= ($on_page + ($split - 1)); $a++) {
                $newPdf->addPage();
                $newPdf->useTemplate($newPdf->importPage($a));
                $last_page = $a;
            }

            $newPdf->output("{$pathFile}/{$on_page}_{$last_page}.pdf", 'F');
        }
        $pdf->close();
        return 's';
        $on_page = $on_page - 1;
        $kurang = ($pageCount - $on_page);
        if ($kurang > 0) {
            $firstPage = ($on_page + 1);
            $lastPage = ($on_page + $kurang);
            if ($firstPage == $lastPage) {
                echo  "{$firstPage}";
            } else {
                echo  "{$firstPage}-{$lastPage}";
            }
        }
    }
}
