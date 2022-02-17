<?php

namespace App\Http\Livewire\Book;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RowBook extends Component
{
    use LivewireAlert;
    public Book $book;

    protected $listeners = [
        'confirmedDelete'
    ];

    public function delete()
    {
        $this->alert('warning', "Yakin ingin menghapus buku ini", [
            'text' => "Ini akan menghapus file buku {$this->book->title}",
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Hapus',
            'onConfirmed' => 'confirmedDelete',
            'showCancelButton' => true,
            'cancelButtonText' => 'Batal',
            'timer' => null
        ]);
    }

    public function confirmedDelete()
    {
        $delete = $this->book->delete();
        if ($delete) {
            $this->emit('refresh');
            Storage::deleteDirectory($this->book->path);
            $this->alert('success', 'Buku dihapus', [
                'text' => "Buku berhasil dihapus",
            ]);
        } else {
            $this->alert('error', 'Gagal menghapus buku', [
                'text' => "terjadi kesalahan, tidak dapat menghapus buku",
            ]);
        }
    }
    public function render()
    {
        return view('livewire.book.row-book');
    }
}
