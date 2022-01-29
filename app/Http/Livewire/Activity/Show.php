<?php

namespace App\Http\Livewire\Activity;

use App\Models\ReadSession;
use Livewire\Component;

class Show extends Component
{
    public function render()
    {
        return view('livewire.activity.show', [
            'activities' => ReadSession::with(['user', 'book'])->get()
        ]);
    }
}
