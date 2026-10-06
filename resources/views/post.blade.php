@extends('layouts.app')

@section('title', 'Artikel & Inspirasi - Nurul Iman')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-xl border border-emerald-100">
            <div class="flex items-center gap-2 mb-4">
                <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider">
                    Inspirasi #{{ $post->userId ?? '1' }}
                </span>
            </div>

            <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 leading-tight">
                {{ $post->title ?? 'Inspirasi Islami' }}
            </h1>

            <div class="mt-6 pt-6 border-t border-slate-100 text-slate-700 leading-relaxed text-base sm:text-lg font-serif">
                {{ $post->body ?? '' }}
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs font-bold text-emerald-800 hover:text-emerald-950">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>
@endsection