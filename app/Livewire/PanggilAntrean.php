<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Antrean;
use Illuminate\Support\Facades\DB;

class PanggilAntrean extends Component
{
    public $poli_id;
    public $current = null;

    public function panggilSelanjutnya($poliId)
    {
        DB::transaction(function () use ($poliId) {

            // ambil antrean berikutnya (waiting)
            $next = Antrean::where('poli_id', $poliId)
                ->where('status_id', 1)
                ->orderBy('number')
                ->first();

            if ($next) {

                // ubah semua called sebelumnya jadi in_progress
                Antrean::where('poli_id', $poliId)
                    ->where('status_id', 2)
                    ->update(['status_id' => 3]);

                // set yang baru jadi called
                $next->update([
                    'status_id' => 2,
                    'called_at' => now(),
                ]);

                // kirim ke frontend buat suara
                $this->dispatch('play-sound', queue: $next->queue_number);

                $this->current = $next->queue_number;
            }
        });
    }

    public function render()
    {
        return view('livewire.panggil-antrean');
    }
}
