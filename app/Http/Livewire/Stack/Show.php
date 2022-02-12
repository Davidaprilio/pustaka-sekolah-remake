<?php

namespace App\Http\Livewire\Stack;

use App\Models\EtalaseBook;
use App\Models\EtalaseGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'refresh-base' => '$refresh'
    ];

    public $etalase;
    public $create_stack = [
        'name' => null,
        'group_id' => null
    ];

    public function addStack()
    {
        $new_stack = EtalaseBook::create([
            'etalase_group_id' => $this->create_stack['group_id'],
            'name' => $this->create_stack['name'],
            'slug' => Str::slug($this->create_stack['name']) . rand(100, 9999),
            'user_id' => Auth::user()->id,
        ]);
        if ($new_stack) {
            $this->emit('refresh-etalase'); //event refresh child etalase card
            $this->alert('success', 'Rak baru berhasil dibuat');
        } else {
            $this->alert('error', 'Opps, gagal membuat rak baru');
        }
        $this->create_stack = [
            'name' => null,
            'group_id' => null
        ];
    }

    /**
     * Tambah Etalase Buku
     */
    public function addEtalase()
    {
        $created = EtalaseGroup::create([
            'user_id' => Auth::id(),
            'name' => $this->etalase,
            'slug' => Str::slug($this->etalase) . rand(10, 9999),
        ]);
        if ($created) {
            $this->alert('success', 'Etalase Baru berhasil dibuat');
        } else {
            $this->alert('error', 'Opps, gagal membuat etalase');
        }
        $this->etalase = null;
    }

    public function render()
    {
        $stack = EtalaseGroup::all();
        $stack->load('etalase');
        return view('livewire.stack.show', [
            'menu_etalase' => $stack
        ]);
    }
}
