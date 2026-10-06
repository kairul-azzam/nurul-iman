@extends('layouts.app')

@section('title', 'Nurul Iman - Beranda')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-12 sm:py-16">
        
        <!-- Clean Hero -->
        <div class="text-center mb-12">
            <p class="font-arabic text-2xl text-brand-800 mb-3">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Selamat Datang di Nurul Iman
            </h1>
            <p class="mt-3 text-slate-600 max-w-lg mx-auto text-sm sm:text-base">
                Aplikasi ibadah praktis untuk membaca Al-Qur'an, mengamalkan doa harian, dan mengecek jadwal shalat tepat waktu.
            </p>
        </div>

        <!-- 3 Main Action Menu Buttons (Clean, Clear, Simple) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            
            <!-- Menu 1: Al-Qur'an -->
            <a href="{{ route('quran.index') }}" 
               class="group p-6 bg-white rounded-2xl border border-slate-200 hover:border-brand-600 hover:shadow-md transition-all flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-brand-700 flex items-center justify-center text-xl mb-4 group-hover:bg-brand-700 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-book-quran"></i>
                    </div>
                    <h2 class="text-lg font-bold text-slate-900 group-hover:text-brand-800 transition-colors">
                        Al-Qur'an
                    </h2>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Baca 114 surat lengkap dengan teks Arab berharakat, terjemahan Indonesia, dan audio murottal.
                    </p>
                </div>
                <div class="mt-6 flex items-center gap-1.5 text-xs font-semibold text-brand-700 group-hover:text-brand-900">
                    <span>Buka Al-Qur'an</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Menu 2: Doa Harian -->
            <a href="{{ route('doa.index') }}" 
               class="group p-6 bg-white rounded-2xl border border-slate-200 hover:border-brand-600 hover:shadow-md transition-all flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-xl mb-4 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-hands-praying"></i>
                    </div>
                    <h2 class="text-lg font-bold text-slate-900 group-hover:text-amber-800 transition-colors">
                        Kumpulan Doa
                    </h2>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Doa sehari-hari bersumber dari hadits shahih, lengkap dengan lafadz Arab, latin, dan artinya.
                    </p>
                </div>
                <div class="mt-6 flex items-center gap-1.5 text-xs font-semibold text-amber-700 group-hover:text-amber-900">
                    <span>Lihat Kumpulan Doa</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Menu 3: Jadwal Shalat -->
            <a href="{{ route('jadwal.index') }}" 
               class="group p-6 bg-white rounded-2xl border border-slate-200 hover:border-brand-600 hover:shadow-md transition-all flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-xl mb-4 group-hover:bg-teal-700 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <h2 class="text-lg font-bold text-slate-900 group-hover:text-teal-800 transition-colors">
                        Jadwal Shalat
                    </h2>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Jadwal shalat 5 waktu dan waktu imsakiyah akurat untuk menjaga ibadah di awal waktu.
                    </p>
                </div>
                <div class="mt-6 flex items-center gap-1.5 text-xs font-semibold text-teal-700 group-hover:text-teal-900">
                    <span>Cek Jadwal Shalat</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

        </div>

        <!-- Clean Backend Post / Quote Section (Simple & Readable) -->
        @if(isset($posts) && is_array($posts))
            <div class="mt-12 p-6 bg-white rounded-2xl border border-slate-200">
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-feather-pointed text-brand-700"></i>
                    <span>Kutipan Hari Ini</span>
                </div>
                <h3 class="text-base font-bold text-slate-900">
                    {{ $posts['title'] ?? 'Inspirasi' }}
                </h3>
                <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                    {{ $posts['body'] ?? '' }}
                </p>
            </div>
        @elseif(isset($quotes) && is_array($quotes))
            <div class="mt-12 p-6 bg-white rounded-2xl border border-slate-200">
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-quote-left text-brand-700"></i>
                    <span>Kutipan</span>
                </div>
                <p class="text-base font-medium text-slate-800 italic">
                    "{{ $quotes['quote'] ?? '' }}"
                </p>
                <p class="mt-2 text-xs font-semibold text-slate-500">
                    — {{ $quotes['author'] ?? '' }}
                </p>
            </div>
        @endif

    </div>
@endsection