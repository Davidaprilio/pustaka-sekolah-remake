<?php

namespace App\Http\Livewire\Stack;

use App\Models\EtalaseBook;
use Livewire\Component;

class CardStack extends Component
{
    public EtalaseBook $etalaseBook;

    public function render()
    {
        return view('livewire.stack.card-stack', [
            'data' => $this->etalaseBook
        ]);
    }
}
