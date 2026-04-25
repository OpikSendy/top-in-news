@extends('layouts.app')

@section('title', 'Kategori ' . $name . ' — Top In News')
@section('meta_description', 'Baca berita terbaru kategori ' . $name . ' dari Top In News. Informasi terkini dan terpercaya.')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-7xl">

    {{-- Category Header Banner --}}
    @php
        $catIcons = ['Technology'=>'💻','Business'=>'📈','Lifestyle'=>'✨','Sports'=>'⚽','Health'=>'🏥','Politics'=>'🏛️','Entertainment'=>'🎬','Science'=>'🔬'];
        $catColors = ['Technology'=>'from-blue-700 to-blue-900','Business'=>'from-emerald-700 to-emerald-900','Lifestyle'=>'from-violet-700 to-violet-900','Sports'=>'from-orange-600 to-orange-900','Health'=>'from-teal-700 to-teal-900','Politics'=>'from-red-700 to-red-900','Entertainment'=>'from-pink-700 to-pink-900','Science'=>'from-sky-700 to-sky-900'];
        $icon = $catIcons[$name] ?? '📰';
        $gradient = $catColors[$name] ?? 'from-gray-700 to-gray-900';
    @endphp

    <div class="relative rounded-2xl overflow-hidden mb-8 bg-gradient-to-r {{ $gradient }} p-8 shadow-xl">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-white to-transparent"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-white/15 rounded-2xl flex items-center justify-center text-3xl shadow-inner backdrop-blur-sm">{{ $icon }}</div>
                <div>
                    <p class="text-white/60 text-xs font-bold uppercase tracking-widest mb-1">Kategori Berita</p>
                    <h1 class="text-3xl font-black text-white">{{ $name }}</h1>
                    <p class="text-white/70 text-sm mt-1">{{ $news->total() }} artikel tersedia</p>
                </div>
            </div>
            <a href="{{ route('top-news') }}" class="hidden sm:flex items-center gap-2 bg-white/15 hover:bg-white/25 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-all backdrop-blur-sm border border-white/20">
                ← Kembali ke Home
            </a>
        </div>
    </div>

    {{-- Category Switcher --}}
    <div class="flex items-center gap-2 overflow-x-auto pb-2 mb-8 scrollbar-none">
        @foreach(['Technology','Business','Lifestyle','Sports','Health','Politics','Entertainment','Science'] as $cat)
            <a href="{{ route('category', $cat) }}"
               class="cat-tab shrink-0 {{ $name === $cat ? 'active' : 'text-gray-600 dark:text-gray-400' }}">
                {{ ($catIcons[$cat] ?? '') }} {{ $cat }}
            </a>
        @endforeach
    </div>

    @if($news->isEmpty())
        <div class="text-center py-24 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm">
            <div class="text-6xl mb-4">📭</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Belum ada berita di kategori ini</h3>
            <p class="text-gray-400 text-sm mb-6">Cek kembali nanti atau jelajahi kategori lain.</p>
            <a href="{{ route('top-news') }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-6 rounded-xl transition-colors text-sm">
                🏠 Kembali ke Home
            </a>
        </div>
    @else

        {{-- Hero + Sidebar layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

            {{-- Hero --}}
            <div class="lg:col-span-2">
                @if($hero)
                    <x-news-hero :hero="$hero" />
                @endif
            </div>

            {{-- Sidebar Trending in Category --}}
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden h-full">
                    <div class="bg-gradient-to-r {{ $gradient }} px-4 py-3">
                        <h3 class="text-white font-black text-sm uppercase tracking-wide">{{ $icon }} Populer di {{ $name }}</h3>
                    </div>
                    <div class="p-2 divide-y divide-gray-50 dark:divide-gray-800">
                        @foreach($sidebar as $i => $item)
                        <div class="flex items-start gap-3 py-3 px-2">
                            <span class="popular-num text-2xl shrink-0 leading-none mt-0.5">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
                            <a href="{{ route('detail-news', $item->id) }}" class="group flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-gray-900 dark:text-white leading-snug group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors line-clamp-2">{{ $item->title }}</h4>
                                <div class="flex items-center gap-2 mt-1">
                                    <time class="text-[11px] text-gray-400">{{ $item->created_at->diffForHumans() }}</time>
                                    <span class="text-[11px] text-gray-400">· {{ number_format($item->views) }} views</span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- All Articles Grid --}}
        <div class="section-title">
            <h2 class="text-2xl font-black text-gray-900 dark:text-white">Semua Artikel {{ $name }}</h2>
            <span class="ml-auto text-xs text-gray-400 font-semibold">{{ $news->total() }} artikel</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($news as $item)
                <x-news-card :item="$item" />
            @endforeach
        </div>

        @if($news->hasPages())
        <div class="mt-10 flex justify-center">
            {{ $news->links() }}
        </div>
        @endif

    @endif
</div>
@endsection
