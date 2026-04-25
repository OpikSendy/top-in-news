@extends('layouts.app')

@section('title', 'Trending Sekarang — Top In News')
@section('meta_description', 'Berita trending paling banyak dibaca dan dibicarakan hari ini di Top In News.')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-7xl">

    {{-- Trending Hero Banner --}}
    <div class="relative rounded-2xl overflow-hidden mb-8 bg-gradient-to-r from-orange-950 to-amber-900 p-8 shadow-xl border border-amber-800/30">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,_rgba(245,158,11,0.2)_0%,_transparent_60%)]"></div>
        <div class="absolute top-2 right-10 text-8xl opacity-10 select-none">🔥</div>

        <div class="relative z-10 flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="bg-amber-500 text-black text-xs font-black px-3 py-1.5 rounded-lg">🔥 TRENDING</span>
                    <span class="text-white/50 text-xs font-semibold">Diperbarui setiap jam</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-white mb-2" style="font-family:'Playfair Display',serif">Trending Sekarang</h1>
                <p class="text-white/60 text-sm">{{ $news->total() }} artikel paling banyak dibaca dan dibicarakan</p>
            </div>
            <a href="{{ route('top-news') }}" class="hidden md:flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-all border border-white/15 backdrop-blur-sm">
                ← Home
            </a>
        </div>
    </div>

    @if($news->isEmpty())
        <div class="text-center py-24 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm">
            <div class="text-6xl mb-4">🔥</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Belum ada berita trending</h3>
            <p class="text-gray-400 text-sm mb-6">Tidak ada berita trending saat ini.</p>
            <a href="{{ route('top-news') }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-6 rounded-xl transition-colors text-sm">
                🏠 Kembali ke Home
            </a>
        </div>
    @else

        {{-- Top 5 Trending — Featured List --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">

            {{-- #1 Big Feature --}}
            @if($news->first())
            <div class="lg:row-span-2">
                <div class="section-title mb-4">
                    <h2 class="text-lg font-black text-gray-900 dark:text-white">#1 Trending Hari Ini</h2>
                </div>
                <x-news-hero :hero="$news->first()" />
            </div>
            @endif

            {{-- #2 - #3 --}}
            @foreach($news->slice(1, 2) as $i => $item)
            <a href="{{ route('detail-news', $item->id) }}" class="news-card group flex gap-4 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-4 items-start">
                <div class="shrink-0 text-center w-12">
                    <span class="popular-num text-3xl leading-none">#{{ $i + 2 }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <span class="text-[10px] font-black uppercase tracking-widest text-red-500 block mb-1">{{ $item->category }}</span>
                    <h3 class="font-black text-gray-900 dark:text-white text-base leading-snug group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors line-clamp-2">{{ $item->title }}</h3>
                    <div class="flex items-center gap-3 mt-2 text-xs text-gray-400">
                        <span>{{ $item->created_at->diffForHumans() }}</span>
                        <span>· 🔥 Trending</span>
                        <span>· {{ number_format($item->views) }} views</span>
                    </div>
                </div>
                <div class="shrink-0 w-20 h-16 rounded-xl overflow-hidden">
                    <img src="https://picsum.photos/120/90?random={{ $item->id }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" loading="lazy" alt="">
                </div>
            </a>
            @endforeach
        </div>

        {{-- Trending Ranks #4+ --}}
        <div class="section-title">
            <h2 class="text-xl font-black text-gray-900 dark:text-white">Semua Trending</h2>
            <span class="ml-auto text-xs text-gray-400">{{ $news->total() }} berita</span>
        </div>

        {{-- List view for #4-#10 --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden mb-8">
            @foreach($news->slice(3, 7) as $i => $item)
            <a href="{{ route('detail-news', $item->id) }}" class="group flex items-center gap-4 px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors {{ $loop->last ? '' : 'border-b border-gray-50 dark:border-gray-800' }}">
                <span class="popular-num text-3xl w-12 text-center shrink-0">#{{ $i + 4 }}</span>
                <img src="https://picsum.photos/80/60?random={{ $item->id }}" class="w-16 h-12 rounded-lg object-cover shrink-0 group-hover:scale-105 transition duration-300" loading="lazy" alt="">
                <div class="flex-1 min-w-0">
                    <span class="text-[10px] font-black uppercase tracking-widest text-red-500 block mb-0.5">{{ $item->category }}</span>
                    <h4 class="font-bold text-gray-900 dark:text-white text-sm leading-snug group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors line-clamp-1">{{ $item->title }}</h4>
                    <span class="text-xs text-gray-400 mt-0.5 block">{{ $item->created_at->diffForHumans() }} · {{ number_format($item->views) }} views</span>
                </div>
                <svg class="w-4 h-4 text-gray-300 shrink-0 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            @endforeach
        </div>

        {{-- Grid for the rest --}}
        @if($news->count() > 10)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($news->slice(10) as $item)
                <x-news-card :item="$item" />
            @endforeach
        </div>
        @endif

        @if($news->hasPages())
        <div class="mt-10 flex justify-center">
            {{ $news->links() }}
        </div>
        @endif

    @endif
</div>
@endsection
