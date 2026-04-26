<div>
    <h2>Admin - Panggil Antrean</h2>

    @foreach(\App\Models\MasterPoli::all() as $poli)
        <div style="border:1px solid #000; padding:15px; margin-bottom:10px;">
            
            <h3>{{ $poli->name }} ({{ $poli->code }})</h3>

            <button wire:click="panggilSelanjutnya({{ $poli->id }})">
                Panggil Berikutnya
            </button>

            <br><br>

            @php
                $called = \App\Models\Antrean::where('poli_id', $poli->id)
                    ->where('status_id', 2)
                    ->latest('called_at')
                    ->first();

                $inProgress = \App\Models\Antrean::where('poli_id', $poli->id)
                    ->where('status_id', 3)
                    ->latest('called_at')
                    ->first();
            @endphp

            <div>
                <strong>Sedang Dipanggil:</strong><br>
                {{ $called?->queue_number ?? '-' }}
            </div>

            <br>

            <div>
                <strong>Sedang Diperiksa:</strong><br>
                {{ $inProgress?->queue_number ?? '-' }}
            </div>

        </div>
    @endforeach
</div>

<script>
    window.addEventListener('play-sound', event => {
        const queue = event.detail.queue;

        // 🔔 suara dingdong dulu
        let bell = new Audio("/audio/dingdong.mp3");
        bell.play();

        // tunggu dikit biar natural
        setTimeout(() => {

            let text = `Nomor antrean ${queue}. Silakan menuju ruang pemeriksaan.`;

            let speech = new SpeechSynthesisUtterance(text);

            speech.lang = 'id-ID';
            speech.rate = 0.75;   // lebih pelan
            speech.pitch = 1;     // normal

            // coba cari voice Indonesia (kalau ada)
            let voices = speechSynthesis.getVoices();
            let indoVoice = voices.find(v => v.lang === 'id-ID');

            if (indoVoice) {
                speech.voice = indoVoice;
            }

            window.speechSynthesis.speak(speech);

        }, 2000); // delay setelah bell

    });
</script>