<?php

namespace App\Http\Livewire\Stack;

use App\Models\EtalaseBook;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CardStack extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmed',
        'refresh-stack' => '$refresh'
    ];

    public EtalaseBook $etalaseBook;

    public function delete()
    {
        $this->alert('warning', 'Yakin ingin menghapus Rak Buku ini?', [
            'text' => "{$this->etalaseBook->name} akan dihapus berarti semua buku yang ada didalamnya akan kehilangan tempatnya dan anda harus menatanya kembali (Buku tidak akan terhapus)",
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Hapus',
            'onConfirmed' => 'confirmed',
            'showCancelButton' => true,
            'cancelButtonText' => 'Batal',
            'timer' => null
        ]);
    }

    /** 
     * Trigger saat confirmed method delete
     */
    public function confirmed()
    {
        $deleted = $this->etalaseBook->delete();
        if ($deleted) {
            $this->emit('refresh-etalase');
            $this->alert('success', 'Rak Buku berhasil dihapus');
        } else {
            $this->alert('error', 'Opps, Rak Buku ini gagal dihapus');
        }
    }

    public function render()
    {
        return view('livewire.stack.card-stack', [
            'data' => $this->etalaseBook
        ]);
    }
}
