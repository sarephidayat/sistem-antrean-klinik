<div style="display:flex; gap:20px; padding:20px;">

    {{-- 🔹 KIRI: NEXT ANTREAN --}}
    <div style="flex:1;">
        <h2>Antrean Berikutnya</h2>

        @foreach($polis as $poli)
            @php
                $next = \App\Models\Antrean::where('poli_id', $poli->id)
                    ->where('status_id', 1) // waiting
                    ->orderBy('number')
                    ->first();
            @endphp

            <div style="border:1px solid #000; padding:20px; margin-bottom:10px;">
                <h3>{{ $poli->name }}</h3>

                @if($next)
                    <h1>{{ $next->queue_number }}</h1>
                @else
                    <span>Tidak ada antrean</span>
                @endif
            </div>
        @endforeach
    </div>

    {{-- 🔹 KANAN: SEDANG DIPERIKSA --}}
    <div style="flex:2;">
        <h2>Sedang Dilayani</h2>

        <div style="display:flex; gap:10px;">

            @foreach($polis as $poli)
                @php
                    $current = \App\Models\Antrean::where('poli_id', $poli->id)
                        ->where('status_id', 3) // in_progress
                        ->latest('called_at')
                        ->first();
                @endphp

                <div style="border:1px solid #000; padding:20px; flex:1; text-align:center;">
                    <h3>{{ $poli->name }}</h3>

                    @if($current)
                        <h1 style="font-size:40px;">{{ $current->queue_number }}</h1>
                        <span>Sedang Dilayani</span>
                    @else
                        <span>Belum ada antrean</span>
                    @endif
                </div>
            @endforeach

        </div>
    </div>

</div>