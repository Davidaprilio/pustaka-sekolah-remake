<?php

namespace App\Http\Livewire\Stack;

use App\Models\EtalaseGroup;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Show extends Component
{
    public $etalase = '';

    public $stack = [
        [
            'id' => '_inprocess',
            'title' => 'In Process',
            'item' => [
                [
                    'title' => '<span class="font-weight-bold">You can drag me too</span>'
                ],
                [
                    'title' => '<span class="font-weight-bold">Buy Milk</span>'
                ]
            ]
        ],
        [
            'id' => '_working',
            'title' => 'Working',
            'item' => [
                [
                    'title' => '<span class="font-weight-bold">Do Something!</span>'
                ],
                [
                    'title' => '<span class="font-weight-bold">Run?</span>'
                ]
            ]
        ],
        [
            'id' => '_done',
            'title' => 'Done',
            'item' => [
                [
                    'title' => '<span class="font-weight-bold">All right</span>'
                ],
                [
                    'title' => '<span class="font-weight-bold">Ok!</span>'
                ]
            ]
        ]
    ];

    public function addEtalase()
    {
        // EtalaseGroup::create([
        //     'name' => $request->name
        // ]);
        $this->emit('created-stack', [
            'id' => '_done',
            'title' => 'Done',
            'item' => [
                [
                    'title' => '<span class="font-weight-bold">All right</span>'
                ],
                [
                    'title' => '<span class="font-weight-bold">Ok!</span>'
                ]
            ]
        ]);
        $this->etalase = '';
    }

    public function test()
    {
        return 'dsdsds';
    }

    public function render()
    {
        return view('livewire.stack.show');
    }
}
