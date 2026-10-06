@extends('layouts.app')

@php
    $nomor = $quran['nomor'] ?? 1;
    $nama = $quran['nama'] ?? '';
    $namaLatin = $quran['namaLatin'] ?? $quran['nama'] ?? '';
    $arti = $quran['arti'] ?? '';
    $jumlahAyat = $quran['jumlahAyat'] ?? count($quran['ayat'] ?? []);
    $tempatTurun = $quran['tempatTurun'] ?? 'Mekah';
    $deskripsi = $quran['deskripsi'] ?? '';
    
    $audioFull = '';
    if (isset($quran['audioFull']) && is_array($quran['audioFull'])) {
        $audioFull = $quran['audioFull']['05'] ?? $quran['audioFull']['06'] ?? reset($quran['audioFull']);
    }

    $prevSurat = $quran['suratSebelumnya'] ?? false;
    $nextSurat = $quran['suratSelanjutnya'] ?? false;
@endphp

@section('title', "Surat {$namaLatin} ({$nama}) - Nurul Iman")

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
        
        <!-- Back Link -->
        <div class="mb-6">
            <a href="{{ route('quran.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Kembali ke Daftar Surat</span>
            </a>
        </div>

        <!-- Clean Surah Header -->
        <div class="p-6 bg-white rounded-2xl border border-slate-200 text-center mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">
                Surat {{ $namaLatin }}
            </h1>
            <p class="font-arabic text-3xl text-brand-900 mt-2 mb-2">
                {{ $nama }}
            </p>
            <p class="text-xs text-slate-500">
                Surat ke-{{ $nomor }} • {{ $tempatTurun }} • {{ $jumlahAyat }} Ayat • Artinya: "{{ $arti }}"
            </p>

            @if($audioFull)
                <div class="mt-4 pt-4 border-t border-slate-100 max-w-sm mx-auto">
                    <p class="text-[11px] text-slate-400 mb-1.5">Putar Full Murottal</p>
                    <audio src="{{ $audioFull }}" controls class="w-full h-9"></audio>
                </div>
            @endif

            @if(!empty($deskripsi))
                <details class="mt-4 pt-4 border-t border-slate-100 text-left text-xs text-slate-600">
                    <summary class="cursor-pointer text-brand-800 font-semibold select-none hover:underline">
                        Keterangan Surat
                    </summary>
                    <div class="mt-2 text-slate-600 leading-relaxed">
                        {!! $deskripsi !!}
                    </div>
                </details>
            @endif
        </div>

        <!-- Bismillah -->
        @if($nomor != 1 && $nomor != 9)
            <div class="text-center py-6 mb-6">
                <p class="font-arabic text-2xl sm:text-3xl text-slate-800">
                    بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                </p>
            </div>
        @endif

        <!-- Verses List -->
        <div class="space-y-4">
            @if(isset($quran['ayat']) && is_array($quran['ayat']))
                @foreach ($quran['ayat'] as $ayat)
                    @php
                        $nomorAyat = $ayat['nomorAyat'] ?? '';
                        $teksArab = $ayat['teksArab'] ?? '';
                        $teksLatin = $ayat['teksLatin'] ?? '';
                        $teksIndo = $ayat['teksIndonesia'] ?? '';
                        
                        $audioAyat = '';
                        if (isset($ayat['audio']) && is_array($ayat['audio'])) {
                            $audioAyat = $ayat['audio']['05'] ?? $ayat['audio']['06'] ?? reset($ayat['audio']);
                        }

                        $copyText = "QS. {$namaLatin}: {$nomorAyat}\n{$teksArab}\n\nArtinya:\n{$teksIndo}";
                    @endphp

                    <div class="p-5 sm:p-6 bg-white rounded-xl border border-slate-200" id="ayat-{{ $nomorAyat }}">
                        
                        <!-- Ayat top bar -->
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 text-xs">
                            <span class="w-7 h-7 rounded-lg bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-xs">
                                {{ $nomorAyat }}
                            </span>

                            <div class="flex items-center gap-2">
                                @if($audioAyat)
                                    <button type="button" 
                                            onclick="playVerseAudio('{{ $audioAyat }}', this)" 
                                            class="p-1.5 rounded-lg text-slate-500 hover:text-brand-700 hover:bg-slate-100 transition-colors"
                                            title="Putar audio ayat">
                                        <i class="fa-solid fa-play text-xs"></i>
                                    </button>
                                @endif
                                <button type="button" 
                                        onclick="copyText(`{{ addslashes($copyText) }}`, 'Ayat {{ $nomorAyat }}')" 
                                        class="p-1.5 rounded-lg text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors"
                                        title="Salin ayat">
                                    <i class="fa-regular fa-copy text-xs"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Arabic -->
                        <div class="py-4 text-right">
                            <p class="font-arabic text-2xl sm:text-3xl text-slate-900 leading-loose">
                                {{ $teksArab }}
                            </p>
                        </div>

                        <!-- Latin Transliteration -->
                        @if(!empty($teksLatin))
                            <p class="text-xs text-brand-800 font-mono italic mb-2">
                                {{ $teksLatin }}
                            </p>
                        @endif

                        <!-- Translation -->
                        <p class="text-xs sm:text-sm text-slate-700 leading-relaxed">
                            {{ $teksIndo }}
                        </p>

                    </div>
                @endforeach
            @endif
        </div>

        <!-- Bottom Pagination (Previous / Next) -->
        <div class="mt-8 pt-6 border-t border-slate-200 flex items-center justify-between text-xs">
            @if($prevSurat && is_array($prevSurat))
                <a href="{{ route('detailquran.show', $prevSurat['nomor']) }}" class="text-brand-800 font-semibold hover:underline">
                    &larr; Surat {{ $prevSurat['namaLatin'] }}
                </a>
            @else
                <div></div>
            @endif

            <a href="{{ route('quran.index') }}" class="text-slate-500 hover:text-slate-800 font-medium">
                Daftar Surat
            </a>

            @if($nextSurat && is_array($nextSurat))
                <a href="{{ route('detailquran.show', $nextSurat['nomor']) }}" class="text-brand-800 font-semibold hover:underline">
                    Surat {{ $nextSurat['namaLatin'] }} &rarr;
                </a>
            @else
                <div></div>
            @endif
        </div>

    </div>
@endsection

@push('scripts')
<script>
    let globalAudio = null;
    let activeBtn = null;

    function playVerseAudio(url, btn) {
        const icon = btn.querySelector('i');

        if (globalAudio && !globalAudio.paused) {
            globalAudio.pause();
            if (activeBtn) {
                const prevIcon = activeBtn.querySelector('i');
                if (prevIcon) {
                    prevIcon.classList.remove('fa-pause');
                    prevIcon.classList.add('fa-play');
                }
            }
            if (activeBtn === btn) {
                activeBtn = null;
                return;
            }
        }

        globalAudio = new Audio(url);
        globalAudio.play().then(() => {
            icon.classList.remove('fa-play');
            icon.classList.add('fa-pause');
            activeBtn = btn;
        }).catch(() => showToast('Gagal memutar audio'));

        globalAudio.onended = () => {
            icon.classList.remove('fa-pause');
            icon.classList.add('fa-play');
            activeBtn = null;
        };
    }
</script>
@endpush