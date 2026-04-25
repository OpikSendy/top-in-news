@extends('layouts.app')

@section('title', 'Semua Berita — Top In News')
@section('meta_description', 'Jelajahi seluruh arsip berita Top In News. Berita terbaru, terpercaya dan terlengkap dari berbagai kategori.')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-7xl">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-black text-gray-900 dark:text-white">📰 Semua Berita</h1>
            <p class="text-gray-400 text-sm mt-0.5">{{ $news->total() }} artikel ditemukan</p>
        </div>
        <a href="{{ route('top-news') }}" class="text-sm font-semibold text-gray-400 hover:text-red-500 transition-colors flex items-center gap-1">
            ← Home
        </a>
    </div>

    {{-- Search & Filter Bar --}}
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-4 mb-6">
        <form action="{{ route('all-news') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul berita..."
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>
            <select name="category" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                <option value="">Semua Kategori</option>
                @foreach(['Technology','Business','Lifestyle','Sports','Health','Politics','Entertainment','Science'] as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <select name="sort" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                <option value="latest" {{ request('sort','latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
            </select>
            <button type="submit" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition-colors shrink-0">Cari</button>
            @if(request('search') || request('category') || request('sort'))
                <a href="{{ route('all-news') }}" class="px-4 py-2.5 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 font-semibold rounded-xl text-sm transition-colors shrink-0">Reset</a>
            @endif
        </form>
    </div>

    {{-- Active Filter Indicator --}}
    @if(request('search') || request('category'))
    <div class="flex items-center gap-2 mb-5 flex-wrap">
        <span class="text-xs text-gray-400 font-semibold">Filter aktif:</span>
        @if(request('search'))
            <span class="inline-flex items-center gap-1.5 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs font-bold px-3 py-1 rounded-full">
                🔍 "{{ request('search') }}"
                <a href="{{ route('all-news', array_merge(request()->except('search', 'page'), ['category' => request('category')])) }}" class="ml-1 hover:text-red-900">✕</a>
            </span>
        @endif
        @if(request('category'))
            <span class="inline-flex items-center gap-1.5 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-bold px-3 py-1 rounded-full">
                📁 {{ request('category') }}
                <a href="{{ route('all-news', array_merge(request()->except('category', 'page'), ['search' => request('search')])) }}" class="ml-1 hover:text-blue-900">✕</a>
            </span>
        @endif
    </div>
    @endif

    @if($news->isEmpty())
        <div class="text-center py-24 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm">
            <div class="text-6xl mb-4">🔍</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Tidak ada berita ditemukan</h3>
            <p class="text-gray-400 text-sm mb-6">Coba gunakan kata kunci yang berbeda.</p>
            <a href="{{ route('all-news') }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-6 rounded-xl transition-colors text-sm">
                Lihat Semua Berita
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($news as $index => $item)

                {{-- Ad slot every 12 items --}}
                @if($index > 0 && $index % 12 === 0)
                <div class="col-span-full">
                    <div class="ad-banner py-4">
                        <span class="text-[9px] text-gray-500 uppercase tracking-widest font-bold block mb-2">Advertisement</span>
                        <div class="h-16 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg flex items-center justify-center text-gray-500 text-xs">[ Ad Space 728x90 ]</div>
                    </div>
                </div>
                @endif

                <x-news-card :item="$item" />
            @endforeach
        </div>

        <div class="mt-10 flex justify-center">
            {{ $news->appends(request()->query())->links() }}
        </div>
    @endif

</div>
@endsection
