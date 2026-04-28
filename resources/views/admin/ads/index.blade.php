@extends('layouts.app')
@section('title', 'Manage Advertisements — Top In News')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-7xl">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2">
                    📢 Kelola Iklan & Kemitraan
                </h1>
                <p class="text-gray-400 text-sm mt-0.5">Atur banner iklan dan promosi partner</p>
            </div>
            <a href="{{ route('admin.ads.create') }}"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl transition-all shadow-lg shadow-blue-600/25 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Iklan Baru
            </a>
        </div>

        {{-- List --}}
        <div
            class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead
                        class="bg-gray-50 dark:bg-gray-800/50 text-xs font-black uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        <tr>
                            <th class="px-5 py-3 w-8">#</th>
                            <th class="px-5 py-3 w-24">Banner</th>
                            <th class="px-5 py-3">Kampanye / Partner</th>
                            <th class="px-5 py-3">Posisi</th>
                            <th class="px-5 py-3 text-right">Klik</th>
                            <th class="px-5 py-3 text-center">Status</th>
                            <th class="px-5 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                        @forelse($ads as $ad)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors group">
                                <td class="px-5 py-3 text-gray-400 text-xs">
                                    {{ $loop->iteration + ($ads->currentPage() - 1) * $ads->perPage() }}</td>
                                <td class="px-5 py-3">
                                    <img src="{{ asset($ad->image_url) }}" class="h-10 object-cover rounded shadow-sm"
                                        alt="Banner">
                                </td>
                                <td class="px-5 py-3">
                                    <div class="font-semibold text-gray-900 dark:text-gray-100">{{ $ad->title }}</div>
                                    <div class="text-xs text-gray-400">{{ $ad->partner_name ?? '-' }}</div>
                                    @if($ad->start_date || $ad->end_date)
                                        <div class="text-[10px] text-gray-400 mt-1">
                                            Masa tayang: {{ $ad->start_date ? $ad->start_date->format('d M Y') : 'Mulai sekarang' }}
                                            - {{ $ad->end_date ? $ad->end_date->format('d M Y') : 'Seterusnya' }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-5 py-3">
                                    <form action="{{ route('admin.ads.updatePosisi', $ad->id) }}" method="POST">
                                        @csrf
                                        <select name="placement" onchange="this.form.submit()"
                                            class="px-2.5 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:opacity-80 rounded-lg text-xs font-bold transition-colors w-20">
                                            <option value="header" {{ $ad->placement == 'header' ? 'selected' : '' }}>Header</option>
                                            <option value="sidebar" {{ $ad->placement == 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                                            <option value="in_article" {{ $ad->placement == 'in_article' ? 'selected' : '' }}>In Article</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-5 py-3 text-right font-black text-gray-700 dark:text-gray-300">
                                    {{ number_format($ad->clicks) }}</td>
                                <td class="px-5 py-3 text-center">
                                    @if($ad->is_active)
                                        <span
                                            class="px-2 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 rounded text-xs font-bold">Aktif</span>
                                    @else
                                        <span
                                            class="px-2 py-1 bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 rounded text-xs font-bold">Non-aktif</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="{{ route('admin.ads.edit', $ad->id) }}"
                                            class="px-2.5 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 hover:bg-amber-200 rounded-lg text-xs font-bold transition-colors">Edit</a>
                                        <form action="{{ route('admin.ads.delete', $ad->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus iklan ini?')">
                                            @csrf
                                            <button
                                                class="px-2.5 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 hover:bg-red-200 rounded-lg text-xs font-bold transition-colors">Hapus</button>
                                        </form>
                                        <form action="{{ route('admin.ads.toggle', $ad->id) }}" method="POST">
                                            @csrf
                                            <button
                                                class="px-2.5 py-1 {{ !$ad->is_active ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }} hover:opacity-80 rounded-lg text-xs font-bold transition-colors w-20">
                                                {{ !$ad->is_active ? 'Aktifkan' : 'Matikan' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-16 text-center text-gray-400">
                                    <p class="text-4xl mb-3">📭</p>
                                    <p class="font-semibold">Belum ada iklan. <a href="{{ route('admin.ads.create') }}"
                                            class="text-blue-500 hover:underline">Buat sekarang</a></p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($ads->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">
                    {{ $ads->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection