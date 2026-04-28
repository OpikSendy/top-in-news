@extends('layouts.app')
@section('title', 'Edit Iklan — Top In News')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">

    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.ads.index') }}" class="p-2 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
            <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <h1 class="text-2xl font-black text-gray-900 dark:text-white">Edit Iklan</h1>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 p-4 rounded-xl mb-6">
            <ul class="list-disc list-inside text-sm font-semibold">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.ads.update', $ad->id) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-sm">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Kampanye / Iklan <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $ad->title) }}" required placeholder="Contoh: Promo Spesial Kemerdekaan" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Partner (Opsional)</label>
                <input type="text" name="partner_name" value="{{ old('partner_name', $ad->partner_name) }}" placeholder="Contoh: Tokopedia" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Link Tujuan / Target URL (Opsional)</label>
            <input type="url" name="link_url" value="{{ old('link_url', $ad->link_url) }}" placeholder="https://example.com" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Posisi Iklan <span class="text-red-500">*</span></label>
                <select name="placement" required class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow">
                    <option value="sidebar" {{ old('placement', $ad->placement) == 'sidebar' ? 'selected' : '' }}>Sidebar (Samping)</option>
                    <option value="header" {{ old('placement', $ad->placement) == 'header' ? 'selected' : '' }}>Header (Atas)</option>
                    <option value="in_article" {{ old('placement', $ad->placement) == 'in_article' ? 'selected' : '' }}>Dalam Artikel (In-Article)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Ganti Gambar Banner</label>
                <input type="file" name="image" accept="image/*" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="text-xs text-gray-400 mt-2">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                <div class="mt-3">
                    <p class="text-xs font-semibold text-gray-500 mb-1">Banner saat ini:</p>
                    <img src="{{ asset($ad->image_url) }}" alt="Current Banner" class="h-20 rounded shadow">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tanggal Mulai Tayang</label>
                <input type="date" name="start_date" value="{{ old('start_date', $ad->start_date ? $ad->start_date->format('Y-m-d') : '') }}" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tanggal Selesai Tayang</label>
                <input type="date" name="end_date" value="{{ old('end_date', $ad->end_date ? $ad->end_date->format('Y-m-d') : '') }}" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow">
            </div>
        </div>

        <div class="mb-8">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $ad->is_active) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Iklan Aktif</span>
            </label>
        </div>

        <div class="flex justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-800">
            <a href="{{ route('admin.ads.index') }}" class="px-6 py-3 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-bold rounded-xl transition-colors">Batal</a>
            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-blue-600/25">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
