@extends('layouts.app')

@php
    $kabkota = $data['kabkota'] ?? 'Kota Bogor';
    $provinsi = $data['provinsi'] ?? 'Jawa Barat';
    $bulanNama = $data['bulan_nama'] ?? date('F');
    $tahun = $data['tahun'] ?? date('Y');
    $jadwalBulan = $data['jadwal'] ?? [];

    $todayDayNum = (int)date('d');
    $todayJadwal = null;

    foreach ($jadwalBulan as $index => $item) {
        $dayPart = (int)date('d', strtotime($item['tanggal_lengkap'] ?? ''));
        if ($dayPart === $todayDayNum || ($index + 1) === $todayDayNum) {
            $todayJadwal = $item;
            break;
        }
    }

    if (!$todayJadwal && !empty($jadwalBulan)) {
        $todayJadwal = $jadwalBulan[0];
    }
@endphp

@section('title', "Jadwal Shalat {$kabkota} - Nurul Iman")

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-8">
        
        <!-- Header -->
        <div class="pb-6 border-b border-slate-200">
            <h1 class="text-2xl font-bold text-slate-900">Jadwal Shalat & Imsakiyah</h1>
            <p class="text-xs text-slate-500 mt-1">
                Wilayah <strong>{{ $kabkota }}, {{ $provinsi }}</strong> • Bulan {{ $bulanNama }} {{ $tahun }}
            </p>
        </div>

        <!-- Today Summary -->
        @if($todayJadwal)
            <div class="my-6 p-5 bg-white rounded-2xl border border-slate-200">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 text-xs text-slate-500">
                    <span class="font-bold text-brand-800 uppercase tracking-wide">
                        Jadwal Hari Ini: {{ $todayJadwal['tanggal_lengkap'] ?? '' }}
                    </span>
                    <span>Waktu Setempat</span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-3 mt-4 text-center">
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-[11px] text-slate-400 block font-medium">Imsak</span>
                        <span class="text-sm font-bold text-slate-800 font-mono mt-0.5 block">{{ $todayJadwal['imsak'] ?? '-' }}</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-brand-50/70 border border-brand-100">
                        <span class="text-[11px] text-brand-700 block font-semibold">Subuh</span>
                        <span class="text-sm font-bold text-brand-900 font-mono mt-0.5 block">{{ $todayJadwal['subuh'] ?? '-' }}</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-[11px] text-slate-400 block font-medium">Terbit</span>
                        <span class="text-sm font-bold text-slate-800 font-mono mt-0.5 block">{{ $todayJadwal['terbit'] ?? '-' }}</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-brand-50/70 border border-brand-100">
                        <span class="text-[11px] text-brand-700 block font-semibold">Dzuhur</span>
                        <span class="text-sm font-bold text-brand-900 font-mono mt-0.5 block">{{ $todayJadwal['dzuhur'] ?? '-' }}</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-brand-50/70 border border-brand-100">
                        <span class="text-[11px] text-brand-700 block font-semibold">Ashar</span>
                        <span class="text-sm font-bold text-brand-900 font-mono mt-0.5 block">{{ $todayJadwal['ashar'] ?? '-' }}</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-amber-50/80 border border-amber-100">
                        <span class="text-[11px] text-amber-700 block font-semibold">Maghrib</span>
                        <span class="text-sm font-bold text-amber-900 font-mono mt-0.5 block">{{ $todayJadwal['maghrib'] ?? '-' }}</span>
                    </div>
                    <div class="p-2.5 rounded-xl bg-brand-50/70 border border-brand-100">
                        <span class="text-[11px] text-brand-700 block font-semibold">Isya</span>
                        <span class="text-sm font-bold text-brand-900 font-mono mt-0.5 block">{{ $todayJadwal['isya'] ?? '-' }}</span>
                    </div>
                </div>
            </div>
        @endif

        <!-- Monthly Table -->
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="px-5 py-3.5 border-b border-slate-100 text-xs font-semibold text-slate-700">
                Tabel Waktu Shalat Bulanan
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 uppercase text-[10px] tracking-wider border-b border-slate-200">
                            <th class="py-3 px-4 font-semibold">Tanggal</th>
                            <th class="py-3 px-3 font-semibold">Hari</th>
                            <th class="py-3 px-3 text-center font-semibold">Imsak</th>
                            <th class="py-3 px-3 text-center font-semibold text-brand-800">Subuh</th>
                            <th class="py-3 px-3 text-center font-semibold">Terbit</th>
                            <th class="py-3 px-3 text-center font-semibold text-brand-800">Dzuhur</th>
                            <th class="py-3 px-3 text-center font-semibold text-brand-800">Ashar</th>
                            <th class="py-3 px-3 text-center font-semibold text-amber-800">Maghrib</th>
                            <th class="py-3 px-3 text-center font-semibold text-brand-800">Isya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($jadwalBulan as $index => $hari)
                            @php
                                $isToday = false;
                                if ($todayJadwal && isset($todayJadwal['tanggal_lengkap']) && $hari['tanggal_lengkap'] === $todayJadwal['tanggal_lengkap']) {
                                    $isToday = true;
                                } elseif (($index + 1) === $todayDayNum) {
                                    $isToday = true;
                                }
                            @endphp

                            <tr class="{{ $isToday ? 'bg-brand-50/80 font-bold text-brand-950' : 'hover:bg-slate-50/70 text-slate-700' }}">
                                <td class="py-2.5 px-4 whitespace-nowrap">
                                    {{ $hari['tanggal_lengkap'] }}
                                    @if($isToday)
                                        <span class="ml-1 text-[10px] bg-brand-700 text-white px-1.5 py-0.2 rounded font-normal">Hari ini</span>
                                    @endif
                                </td>
                                <td class="py-2.5 px-3 font-medium whitespace-nowrap">
                                    {{ $hari['hari'] }}
                                </td>
                                <td class="py-2.5 px-3 text-center font-mono text-slate-500">
                                    {{ $hari['imsak'] }}
                                </td>
                                <td class="py-2.5 px-3 text-center font-mono {{ $isToday ? 'text-brand-900 font-bold' : '' }}">
                                    {{ $hari['subuh'] }}
                                </td>
                                <td class="py-2.5 px-3 text-center font-mono text-slate-500">
                                    {{ $hari['terbit'] }}
                                </td>
                                <td class="py-2.5 px-3 text-center font-mono {{ $isToday ? 'text-brand-900 font-bold' : '' }}">
                                    {{ $hari['dzuhur'] }}
                                </td>
                                <td class="py-2.5 px-3 text-center font-mono {{ $isToday ? 'text-brand-900 font-bold' : '' }}">
                                    {{ $hari['ashar'] }}
                                </td>
                                <td class="py-2.5 px-3 text-center font-mono {{ $isToday ? 'text-amber-900 font-bold' : '' }}">
                                    {{ $hari['maghrib'] }}
                                </td>
                                <td class="py-2.5 px-3 text-center font-mono {{ $isToday ? 'text-brand-900 font-bold' : '' }}">
                                    {{ $hari['isya'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-5 py-3 bg-slate-50 text-[11px] text-slate-400 border-t border-slate-100">
                Sumber hisab jadwal shalat: Kementerian Agama Republik Indonesia.
            </div>
        </div>

    </div>
@endsection