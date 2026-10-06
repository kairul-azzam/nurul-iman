@extends('layouts.app')

@section('title', 'Al-Qur\'an Digital - Nurul Iman')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Al-Qur'an Digital</h1>
                <p class="text-xs text-slate-500 mt-1">Daftar 114 surat Al-Qur'an lengkap dengan terjemahan dan murottal</p>
            </div>

            <!-- Simple Search Input -->
            <div class="w-full sm:w-72">
                <div class="relative">
                    <input type="text" 
                           id="search-input" 
                           placeholder="Cari surat atau nomor..." 
                           class="w-full pl-9 pr-3 py-2 text-xs rounded-xl bg-white border border-slate-300 focus:outline-none focus:border-brand-600 focus:ring-1 focus:ring-brand-600">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
                </div>
            </div>
        </div>

        <!-- Surah Grid -->
        <div id="surah-list" class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 mt-6">
            @foreach ($quran as $surat)
                @php
                    $nomor = $surat['nomor'] ?? '';
                    $namaLatin = $surat['namaLatin'] ?? $surat['nama'];
                    $namaArab = $surat['nama'] ?? '';
                    $arti = $surat['arti'] ?? '';
                    $tempatTurun = $surat['tempatTurun'] ?? 'Mekah';
                    $jumlahAyat = $surat['jumlahAyat'] ?? 0;
                @endphp

                <a href="{{ route('detailquran.show', $nomor) }}" 
                   class="surah-item p-4 bg-white rounded-xl border border-slate-200 hover:border-brand-600 hover:bg-slate-50/50 transition-all flex items-center justify-between gap-4"
                   data-search="{{ strtolower($namaLatin . ' ' . $namaArab . ' ' . $arti . ' ' . $nomor) }}">
                    
                    <div class="flex items-center gap-3.5 min-w-0">
                        <!-- Number -->
                        <span class="w-9 h-9 rounded-lg bg-slate-100 text-slate-700 font-bold text-xs flex items-center justify-center flex-shrink-0">
                            {{ $nomor }}
                        </span>

                        <!-- Info -->
                        <div class="truncate">
                            <h3 class="font-bold text-sm text-slate-900 group-hover:text-brand-800 truncate">
                                {{ $namaLatin }}
                            </h3>
                            <p class="text-xs text-slate-500 truncate">
                                {{ $arti }} • <span class="capitalize">{{ $tempatTurun }}</span> ({{ $jumlahAyat }})
                            </p>
                        </div>
                    </div>

                    <!-- Arabic Name -->
                    <div class="text-right flex-shrink-0">
                        <span class="font-arabic text-xl text-brand-900">
                            {{ $namaArab }}
                        </span>
                    </div>

                </a>
            @endforeach
        </div>

        <!-- Empty search result -->
        <div id="no-result" class="hidden text-center py-12 text-slate-500 text-xs">
            Surat tidak ditemukan.
        </div>

    </div>
@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('search-input');
    const items = document.querySelectorAll('.surah-item');
    const noResult = document.getElementById('no-result');

    searchInput.addEventListener('input', (e) => {
        const query = e.target.value.toLowerCase().trim();
        let visible = 0;

        items.forEach(item => {
            const data = item.getAttribute('data-search') || '';
            if (!query || data.includes(query)) {
                item.classList.remove('hidden');
                visible++;
            } else {
                item.classList.add('hidden');
            }
        });

        if (visible === 0) {
            noResult.classList.remove('hidden');
        } else {
            noResult.classList.add('hidden');
        }
    });
</script>
@endpush