@extends('layouts.app')

@php
    $id = $doa['id'] ?? '';
    $nama = $doa['nama'] ?? 'Doa Harian';
    $grup = $doa['grup'] ?? '';
    $ar = $doa['ar'] ?? '';
    $tr = $doa['tr'] ?? '';
    $idn = $doa['idn'] ?? '';
    $tentang = $doa['tentang'] ?? '';

    $fullCopy = "{$nama}\n\n{$ar}\n\nLatin:\n{$tr}\n\nArtinya:\n{$idn}" . (!empty($tentang) ? "\n\nSumber/Riwayat:\n{$tentang}" : "");
@endphp

@section('title', "{$nama} - Nurul Iman")

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 py-8">
        
        <!-- Back Link -->
        <div class="mb-6">
            <a href="{{ route('doa.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Kembali ke Kumpulan Doa</span>
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8">
            
            <!-- Header -->
            <div class="pb-6 border-b border-slate-100">
                @if(!empty($grup))
                    <span class="inline-block bg-slate-100 text-slate-600 text-xs px-2.5 py-1 rounded-md font-medium mb-2">
                        {{ $grup }}
                    </span>
                @endif
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900">
                    {{ $nama }}
                </h1>
            </div>

            <!-- Arabic Text -->
            @if(!empty($ar))
                <div class="py-8 text-right">
                    <p class="font-arabic text-2xl sm:text-3xl text-slate-900 leading-loose">
                        {{ $ar }}
                    </p>
                </div>
            @endif

            <!-- Latin Transliteration -->
            @if(!empty($tr))
                <div class="p-4 bg-slate-50 rounded-xl mb-4">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Pelafalan Latin</p>
                    <p class="text-sm text-slate-700 italic font-mono leading-relaxed">
                        {{ $tr }}
                    </p>
                </div>
            @endif

            <!-- Indonesian Meaning -->
            @if(!empty($idn))
                <div class="p-4 bg-slate-50 rounded-xl mb-6">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Artinya</p>
                    <p class="text-sm text-slate-800 leading-relaxed">
                        {{ $idn }}
                    </p>
                </div>
            @endif

            <!-- Hadith Info -->
            @if(!empty($tentang))
                <div class="p-4 border-l-2 border-brand-700 bg-brand-50/50 rounded-r-xl text-xs text-slate-700 leading-relaxed mb-6 whitespace-pre-line">
                    <strong class="text-brand-900 block mb-1">Keterangan / Riwayat:</strong>
                    {{ $tentang }}
                </div>
            @endif

            <!-- Action Bar -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                <button type="button" 
                        onclick="copyText(`{{ addslashes($fullCopy) }}`, 'Doa')" 
                        class="px-4 py-2 bg-brand-700 hover:bg-brand-800 text-white rounded-xl text-xs font-semibold flex items-center gap-1.5 transition-colors">
                    <i class="fa-regular fa-copy"></i>
                    <span>Salin Seluruh Teks Doa</span>
                </button>

                <a href="{{ route('doa.index') }}" class="text-xs text-slate-500 hover:text-slate-800">
                    Lihat Doa Lainnya
                </a>
            </div>

        </div>

    </div>
@endsection