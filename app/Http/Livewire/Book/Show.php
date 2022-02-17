<?php

namespace App\Http\Livewire\Book;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithFileUploads;
use setasign\Fpdi\Fpdi;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public $book;
    public $bookDelete;
    private $name_book;

    /**
     * Lansung Simpan Setelah Upload Selesai
     */
    public function updatedBook()
    {
        $this->validate([
            'book' => 'required|mimes:pdf,odf', // 1MB Max
        ]);
        $original_name = $this->book->getClientOriginalName();
        $path = $this->book->store('public/book');
        $data = self::split_pdf($path);
        $this->book = null;
        $book = Book::create([
            'user_id' => Auth::user()->id,
            'title' => str_replace('.pdf', '', $original_name),
            'path' => $data['path'],
            'files' => $data['files'],
            'pages' => $data['pages'],
            'cover' => '-',
            'slug' => Str::slug($original_name) . Str::random(4),
            'download' => 0,
            'read' => 0
        ]);
        Storage::deleteDirectory("livewire-tmp");
    }

    /**
     * Membagi File PDF per-halaman 
     * Menjadi File PDF baru
     */
    /**
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
        // Split each page into a new PDF

        $index = 0;
        $split = 4;
        $on_page = 1;
        for ($i = 1; $i <= ($pageCount / $split); $i++) {
            $newPdf = new Fpdi();
            $newPdf->setSourceFile($pathFile);

            $first_page = $on_page;
            $last_page = 0;
            $page_arr = [];
            for ($a = 1; $a <= $split; $a++) {
                $page_arr[$a - 1] = $on_page;
                $templateId = $newPdf->importPage($on_page);
                $sizePage = $newPdf->getTemplateSize($templateId);
                $newPdf->AddPage($sizePage['orientation'], [
                    $sizePage['width'],
                    $sizePage['height']
                ]);
                $newPdf->useTemplate($templateId);
                $last_page = $on_page;
                $on_page++;
            }
            $nama_file = "{$first_page}-{$last_page}";
            $data['files'][$nama_file] = $page_arr;
            $index++;
            $storage_path = "{$path_books}/{$nama_file}.pdf";
            $newPdf->output($storage_path, 'F');
            $newPdf->close();
        }
        $on_page--;
        $kurang = ($pageCount - $on_page);
        if ($kurang > 0) {
            $newPdf = new Fpdi();
            $newPdf->setSourceFile($pathFile);
            $first_page = ($on_page + 1);
            $page_arr = [];
            for ($i = 1; $i <= $kurang; $i++) {
                $on_page++;
                $page_arr[$i - 1] = $on_page;
                $templateId = $newPdf->importPage($on_page);
                $sizePage = $newPdf->getTemplateSize($templateId);
                $newPdf->AddPage($sizePage['orientation'], [
                    $sizePage['width'],
                    $sizePage['height']
                ]);
                $newPdf->useTemplate($templateId);
            }

            $nama_file = $first_page == $on_page
                ? "{$first_page}"
                : "{$first_page}-{$last_page}";
            $data['files'][$index] = $nama_file;
            $storage_path = "{$path_books}/{$nama_file}.pdf";

            $newPdf->output($storage_path, 'F');
            $newPdf->close();
        }
        Storage::delete($storepath);
        return $data;
    }
     */

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

    public function render()
    {
        // $arrayOfObjects = [
        //     '1-5' => [1, 2, 3, 4, 5],
        //     '5-6' => [6, 7, 8, 9.10]
        // ];
        // $searchedValue = 4;
        // $neededObject = array_filter(
        //     $arrayOfObjects,
        //     function ($arr) use (&$searchedValue) {
        //         $hasil = array_search($searchedValue, $arr);
        //         return is_bool($hasil) ? false : true;
        //     }
        // );
        return view('livewire.book.show', [
            'books' => Book::orderBy('created_at', 'DESC')->get()
        ]);
    }
}
