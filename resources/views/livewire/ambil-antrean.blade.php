<div style="max-width:600px; margin:auto; text-align:center;">
    
    <h2>Ambil Antrean</h2>

    <div style="display:flex; flex-wrap:wrap; gap:10px; justify-content:center;">

        @foreach($polis as $poli)
            <div 
                wire:click="ambilAntrean({{ $poli->id }})"
                style="
                    border:1px solid #000;
                    padding:20px;
                    width:150px;
                    cursor:pointer;
                "
            >
                <h3>{{ $poli->name }}</h3>
                <small>Kode: {{ $poli->code }}</small>
            </div>
        @endforeach

    </div>

    {{-- HASIL ANTREAN --}}
    @if($result)
        <div id="result-box"
             style="
                margin-top:40px;
                padding:20px;
                border:2px solid #000;
                display:inline-block;
             ">
            <h3>Nomor Antrean Anda</h3>
            <h1 style="font-size:40px;">{{ $result }}</h1>
        </div>

        <script>
            setTimeout(() => {
                document.getElementById('result-box')?.remove();
            }, 5000);
        </script>
        
    @endif

</div>

<script>
    window.addEventListener('clear-result', () => {
        setTimeout(() => {
            Livewire.dispatch('resetResult');
        }, 5000);
    });
</script>