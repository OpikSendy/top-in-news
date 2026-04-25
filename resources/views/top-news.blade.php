@extends('layouts.app')

@section('title', 'Top In News — Berita Terkini Terpercaya')
@section('meta_description', 'Baca berita terbaru, terpercaya dan terlengkap. Breaking news, trending, live coverage dari seluruh Indonesia dan dunia.')

@section('breaking')
    @foreach($breaking as $item)
        <span class="mx-4">
            <span class="text-red-300 font-bold">•</span>
            <a href="{{ route('detail-news', $item->id) }}" class="hover:underline hover:text-red-200 transition-colors ml-2">{{ $item->title }}</a>
        </span>
    @endforeach
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">

    {{-- ===== CATEGORY FILTER TABS ===== --}}
    <div class="flex items-center gap-2 overflow-x-auto pb-2 mb-8 scrollbar-none">
        <a href="{{ route('top-news') }}" class="cat-tab {{ !request('category') ? 'active' : 'text-gray-600 dark:text-gray-400' }}">🏠 Semua</a>
        @foreach(['Technology','Business','Lifestyle','Sports','Health','Politics','Entertainment','Science'] as $cat)
            <a href="{{ route('top-news', ['category' => $cat]) }}" class="cat-tab {{ request('category') == $cat ? 'active' : 'text-gray-600 dark:text-gray-400' }}">{{ $cat }}</a>
        @endforeach
    </div>

    {{-- ===== SEARCH BAR ===== --}}
    @if(request('search') || request('category'))
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800/50 text-blue-800 dark:text-blue-300 p-4 rounded-xl mb-6 flex items-center justify-between">
        <div class="flex items-center gap-2 text-sm">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            @if(request('search')) Hasil pencarian: <strong>"{{ request('search') }}"</strong> @endif
            @if(request('category')) Kategori: <strong>{{ request('category') }}</strong> @endif
        </div>
        <a href="{{ route('top-news') }}" class="text-xs font-bold hover:underline">Reset ✕</a>
    </div>
    @endif

    {{-- ===== HERO + SIDEBAR ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

        {{-- HERO LEFT --}}
        <div class="lg:col-span-2 flex flex-col gap-4">
            @if($hero)
                <x-news-hero :hero="$hero" />

                {{-- Sub grid 3 cards --}}
                @if($grid->count() >= 3)
                <div class="grid grid-cols-3 gap-3">
                    @foreach($grid->take(3) as $item)
                        <x-news-card :item="$item" />
                    @endforeach
                </div>
                @endif
            @else
                <div class="flex items-center justify-center h-64 bg-gray-100 dark:bg-gray-800 rounded-2xl">
                    <p class="text-gray-400">Belum ada berita tersedia.</p>
                </div>
            @endif
        </div>

        {{-- SIDEBAR --}}
        <div class="lg:col-span-1 flex flex-col gap-4">

            {{-- Trending --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-red-600 to-red-700 px-4 py-3 flex items-center gap-2">
                    <span class="text-lg">🔥</span>
                    <h3 class="text-white font-black text-sm tracking-wide uppercase">Trending Sekarang</h3>
                </div>
                <div class="p-2 divide-y divide-gray-50 dark:divide-gray-800">
                    @foreach($trending as $i => $item)
                        <div class="flex items-start gap-3 py-3 px-2">
                            <span class="popular-num text-2xl shrink-0 leading-none mt-0.5">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
                            <a href="{{ route('detail-news', $item->id) }}" class="group">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-red-500 block mb-0.5">{{ $item->category }}</span>
                                <h4 class="text-sm font-bold text-gray-900 dark:text-white leading-snug group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors line-clamp-2">{{ $item->title }}</h4>
                                <time class="text-[11px] text-gray-400 mt-1 block">{{ $item->created_at->diffForHumans() }}</time>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Live News --}}
            @if($live->count() > 0)
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-4 py-3 flex items-center gap-2">
                    <span class="live-dot"></span>
                    <h3 class="text-white font-black text-sm tracking-wide uppercase">Live Coverage</h3>
                </div>
                <div class="p-2">
                    @foreach($live->take(4) as $item)
                        <x-news-mini :item="$item" />
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Popular --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-amber-500 to-orange-600 px-4 py-3 flex items-center gap-2">
                    <span class="text-lg">📈</span>
                    <h3 class="text-white font-black text-sm tracking-wide uppercase">Paling Banyak Dibaca</h3>
                </div>
                <div class="p-2">
                    @foreach($popular->take(4) as $item)
                        <x-news-mini :item="$item" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ===== LATEST NEWS GRID ===== --}}
    <div class="section-title">
        <h2 class="text-2xl font-black text-gray-900 dark:text-white">Berita Terbaru</h2>
        <a href="{{ route('all-news') }}" class="ml-auto text-sm font-bold text-red-600 hover:text-red-700 dark:text-red-400 flex items-center gap-1">
            Lihat Semua <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @foreach($grid->slice(3) as $index => $item)

            {{-- Ad Banner every 8 items --}}
            @if($index > 0 && $index % 8 === 0)
            <div class="col-span-full">
                <div class="ad-banner">
                    <span class="text-[9px] text-gray-500 uppercase tracking-widest font-bold block mb-2">Advertisement</span>
                    <img src="https://picsum.photos/1200/120?random=ad{{ $index }}" class="w-full h-[90px] object-cover rounded-lg opacity-80 hover:opacity-100 transition-opacity" alt="Ad">
                </div>
            </div>
            @endif

            <x-news-card :item="$item" />
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($news->hasPages())
    <div class="mt-10 flex justify-center">
        {{ $news->appends(request()->query())->links() }}
    </div>
    @endif

</div>
@endsection
