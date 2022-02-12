<?php

namespace App\Http\Livewire\Stack;

use App\Models\EtalaseGroup;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CardEtalase extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmed'
    ];

    public EtalaseGroup $etalaseGroup;

    public function delete()
    {
        $this->alert('warning', 'Yakin ingin menghapus data ini?', [
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
        $deleted = $this->etalaseGroup->delete();
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
