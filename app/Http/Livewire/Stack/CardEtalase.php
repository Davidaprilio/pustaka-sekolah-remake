<?php

namespace App\Http\Livewire\Stack;

use App\Models\EtalaseGroup;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CardEtalase extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmed',
        'refresh-etalase' => '$refresh'
    ];

    public EtalaseGroup $etalaseGroup;

    public function delete()
    {
        $this->alert('warning', 'Yakin ingin menghapus etalase ini?', [
            'text' => "ini juga akan menghapus semua rak yang ada di etalse {$this->etalaseGroup->name}",
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
        try {
            $this->etalaseGroup->etalase()->delete();
        } catch (\Throwable $th) {
            $this->alert('error', 'Gagal menghapus rak buku');
        }
        try {
            $deleted = $this->etalaseGroup->delete();
        } catch (\Throwable $th) {
            $this->alert('error', 'Gagal menghapus etalase');
        }
        if ($deleted) {
            $this->emit('refresh-base');
            $this->alert('success', 'Data berhasil dihapus');
        } else {
            $this->alert('error', 'Opps, data ini gagal dihapus');
        }
    }

    public function render()
    {
        return view('livewire.stack.card-etalase', [
            'data' => $this->etalaseGroup
        ]);
    }
}
