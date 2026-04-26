<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MasterPoli;

class DisplayAntrean extends Component
{
    public function render()
    {
        return view('livewire.display-antrean', [
            'polis' => MasterPoli::all()
        ]);
    }
}
