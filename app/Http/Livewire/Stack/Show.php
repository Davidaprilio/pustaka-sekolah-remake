<?php

namespace App\Http\Livewire\Stack;

use App\Models\EtalaseBook;
use App\Models\EtalaseGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'refresh-base' => '$refresh'
    ];

    public function test()
    {
        dd('tested');
    }

    public $etalase;
    public $stack = [];
    public $create_stack = [
        'name' => null,
        'group_id' => null
    ];
    public $etalase_data;

    /**
     * Menyiapkan Data RakBuku Untuk Dirender Oleh jKanban
     */
    public function mount()
    {
        $stack = EtalaseGroup::all();
        $this->create_stack['group_id'] = $stack[0]->id;
        $this->etalase_data = $stack;
        $stack->load('etalase');
        $menu_etalase = [];
        foreach ($stack as $item) {
            $items = [];
            foreach ($item->etalase as $s) {
                array_push($items, [
                    'id' => $s->id,
                    'title' => $s->name
                ]);
            }
            array_push($menu_etalase, [
                'id' => $item->id,
                'title' => $item->name,
                'item' => $items
            ]);
        }
        $this->stack = $menu_etalase;
    }


    public function addStack()
    {
        $new_stack = EtalaseBook::create([
            'etalase_group_id' => $this->create_stack['group_id'],
            'name' => $this->create_stack['name'],
            'slug' => Str::slug($this->create_stack['name']) . rand(100, 9999),
            'user_id' => Auth::user()->id,
        ]);
    }

    /**
     * Tambah Etalase Buku
     */
    public function addEtalase()
    {
        $data = EtalaseGroup::create([
            'user_id' => Auth::id(),
            'name' => $this->etalase,
            'slug' => Str::slug($this->etalase) . rand(10, 9999),
        ]);
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
