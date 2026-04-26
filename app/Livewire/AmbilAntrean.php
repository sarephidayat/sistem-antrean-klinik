<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MasterPoli;
use App\Models\Antrean;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AmbilAntrean extends Component
{
    public $poli_id;
    public $result = null;

    public function ambilAntrean($poliId)
    {
        DB::transaction(function () use ($poliId) {

            $poli = MasterPoli::find($poliId);

            $last = Antrean::where('poli_id', $poliId)
                ->whereDate('antrean_date', today())
                ->max('number');

            $next = $last ? $last + 1 : 1;

            $queueNumber = $poli->code . str_pad($next, 3, '0', STR_PAD_LEFT);

            Antrean::create([
                'poli_id' => $poliId,
                'antrean_date' => today(),
                'number' => $next,
                'queue_number' => $queueNumber,
                'status_id' => 1,
            ]);

            $this->result = $queueNumber;

            // reset otomatis setelah 5 detik (server side)
            $this->dispatch('clear-result');
        });
    }

    public function render()
    {
        return view('livewire.ambil-antrean', [
            'polis' => MasterPoli::all()
        ]);
    }
    protected $listeners = ['resetResult'];

    public function resetResult()
    {
        $this->result = null;
    }
}
