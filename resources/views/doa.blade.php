@extends('layouts.app')

@php
    $searchQuery = trim(request('q', ''));
    $selectedGrup = trim(request('grup', ''));
    $currentPage = max(1, (int) request('page', 1));
    $perPage = 12;

    $doaCollection = collect($doa ?? []);

    // Filter categories
    $allGrups = $doaCollection->pluck('grup')->filter()->unique()->values();

    if (!empty($searchQuery)) {
        $doaCollection = $doaCollection->filter(function($item) use ($searchQuery) {
            $nama = strtolower($item['nama'] ?? '');
            $grup = strtolower($item['grup'] ?? '');
            $idn = strtolower($item['idn'] ?? '');
            $q = strtolower($searchQuery);
            return str_contains($nama, $q) || str_contains($grup, $q) || str_contains($idn, $q);
        });
    }

    if (!empty($selectedGrup)) {
        $doaCollection = $doaCollection->filter(function($item) use ($selectedGrup) {
            return strtolower($item['grup'] ?? '') === strtolower($selectedGrup);
        });
    }

    $totalItems = $doaCollection->count();
    $totalPages = max(1, (int) ceil($totalItems / $perPage));
    
    if ($currentPage > $totalPages) {
        $currentPage = $totalPages;
    }

    $currentPageItems = $doaCollection->forPage($currentPage, $perPage)->values();

    $range = 2;
    $startPage = max(1, $currentPage - $range);
    $endPage = min($totalPages, $currentPage + $range);
@endphp

@section('title', 'Kumpulan Doa Harian - Nurul Iman')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
        
        <!-- Header -->
        <div class="pb-6 border-b border-slate-200">
            <h1 class="text-2xl font-bold text-slate-900">Kumpulan Doa Harian</h1>
            <p class="text-xs text-slate-500 mt-1">Koleksi doa sehari-hari bersumber dari hadits shahih</p>

            <!-- Search & Filter Bar -->
            <form method="GET" action="{{ route('doa.index') }}" class="mt-4 flex flex-col sm:flex-row gap-2.5">
                <div class="relative flex-grow">
                    <input type="text" 
                           name="q" 
                           value="{{ $searchQuery }}" 
                           placeholder="Cari nama doa atau arti..." 
                           class="w-full pl-9 pr-3 py-2 text-xs rounded-xl bg-white border border-slate-300 focus:outline-none focus:border-brand-600 focus:ring-1 focus:ring-brand-600">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
                </div>

                <div class="sm:w-56">
                    <select name="grup" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl bg-white border border-slate-300 focus:outline-none focus:border-brand-600">
                        <option value="">Semua Kategori</option>
                        @foreach($allGrups as $g)
                            <option value="{{ $g }}" {{ $selectedGrup === $g ? 'selected' : '' }}>
                                {{ $g }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="px-4 py-2 bg-brand-700 hover:bg-brand-800 text-white rounded-xl text-xs font-semibold transition-colors">
                    Cari
                </button>

                @if(!empty($searchQuery) || !empty($selectedGrup))
                    <a href="{{ route('doa.index') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-medium text-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Count indicator -->
        <div class="flex items-center justify-between text-xs text-slate-500 my-4">
            <span>Ditemukan <strong>{{ $totalItems }}</strong> doa</span>
            @if($totalPages > 1)
                <span>Halaman {{ $currentPage }} dari {{ $totalPages }}</span>
            @endif
        </div>

        <!-- Doa List (Clean 2-Column Grid) -->
        @if($totalItems > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($currentPageItems as $doas)
                    @php
                        $id = $doas['id'] ?? '';
                        $nama = $doas['nama'] ?? 'Doa';
                        $grup = $doas['grup'] ?? '';
                        $ar = $doas['ar'] ?? '';
                        $idn = $doas['idn'] ?? '';
                        $detailUrl = route('doa.show', $id);
                        $copyContent = "{$nama}\n\n{$ar}\n\nArtinya:\n{$idn}";
                    @endphp

                    <div class="p-4 bg-white rounded-xl border border-slate-200 hover:border-slate-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-[11px] text-slate-400 mb-1.5">
                                <span class="bg-slate-100 px-2 py-0.5 rounded text-slate-600 font-medium truncate max-w-[180px]">
                                    {{ $grup ?: 'Umum' }}
                                </span>
                                <span>#{{ $id }}</span>
                            </div>

                            <h2 class="font-bold text-sm text-slate-900 leading-snug">
                                <a href="{{ $detailUrl }}" class="hover:text-brand-700">
                                    {{ $nama }}
                                </a>
                            </h2>

                            @if(!empty($ar))
                                <p class="font-arabic text-base text-slate-800 text-right my-2 truncate">
                                    {{ $ar }}
                                </p>
                            @endif

                            @if(!empty($idn))
                                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                    {{ $idn }}
                                </p>
                            @endif
                        </div>

                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <button type="button" 
                                    onclick="copyText(`{{ addslashes($copyContent) }}`, 'Doa')" 
                                    class="text-slate-400 hover:text-slate-700 flex items-center gap-1">
                                <i class="fa-regular fa-copy text-xs"></i>
                                <span>Salin</span>
                            </button>

                            <a href="{{ $detailUrl }}" class="text-brand-800 font-semibold hover:underline flex items-center gap-1">
                                <span>Baca Doa</span>
                                <i class="fa-solid fa-angle-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Clean Simple Pagination -->
            @if($totalPages > 1)
                <div class="mt-8 flex justify-center items-center gap-1.5 text-xs">
                    @if($currentPage > 1)
                        <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-medium">
                            Sebelumnya
                        </a>
                    @endif

                    @for($p = $startPage; $p <= $endPage; $p++)
                        @if($p === $currentPage)
                            <span class="w-8 h-8 rounded-lg bg-brand-800 text-white font-bold flex items-center justify-center">
                                {{ $p }}
                            </span>
                        @else
                            <a href="{{ request()->fullUrlWithQuery(['page' => $p]) }}" class="w-8 h-8 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 flex items-center justify-center">
                                {{ $p }}
                            </a>
                        @endif
                    @endfor

                    @if($currentPage < $totalPages)
                        <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage + 1]) }}" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-medium">
                            Selanjutnya
                        </a>
                    @endif
                </div>
            @endif

        @else
            <div class="text-center py-12 text-slate-500 text-xs">
                Tidak ada doa yang sesuai dengan pencarian.
            </div>
        @endif

    </div>
@endsection