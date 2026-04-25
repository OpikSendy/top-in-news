@extends('layouts.app')

@section('title', 'Live Coverage — Top In News')
@section('meta_description', 'Pantau berita LIVE terbaru dari Top In News. Liputan langsung kejadian terkini dari seluruh penjuru dunia.')

@section('breaking')
    @foreach($liveNews->take(5) as $item)
        <span class="mx-4"><span class="text-red-300 font-bold">•</span> <a href="{{ route('detail-news', $item->id) }}" class="hover:underline hover:text-red-200 transition-colors ml-2">{{ $item->title }}</a></span>
    @endforeach
@endsection

@section('content')
<div class="container mx-auto px-4 py-8 max-w-7xl">

    {{-- LIVE Hero Banner --}}
    <div class="relative rounded-2xl overflow-hidden mb-8 bg-gradient-to-r from-gray-950 to-red-950 p-8 shadow-xl border border-red-900/40">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(225,29,72,0.15)_0%,_transparent_70%)]"></div>

        {{-- Animated background dots --}}
        <div class="absolute top-4 right-8 w-32 h-32 bg-red-600/10 rounded-full blur-2xl animate-pulse"></div>
        <div class="absolute bottom-0 right-32 w-20 h-20 bg-red-400/10 rounded-full blur-xl animate-pulse" style="animation-delay:0.5s"></div>

        <div class="relative z-10 flex items-center justify-between">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <div class="flex items-center gap-2 bg-red-600 text-white text-xs font-black px-3 py-1.5 rounded-lg shadow-lg">
                        <span class="w-2 h-2 bg-white rounded-full animate-ping inline-block"></span>
                        LIVE NOW
                    </div>
                    <span class="text-white/40 text-xs font-semibold" id="live-clock"></span>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-white mb-2" style="font-family:'Playfair Display',serif">Live Coverage</h1>
                <p class="text-white/60 text-sm">Pantau kejadian terkini secara langsung — {{ $liveNews->total() }} siaran aktif</p>
            </div>
            <a href="{{ route('top-news') }}" class="hidden md:flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-all border border-white/15 backdrop-blur-sm">
                ← Home
            </a>
        </div>
    </div>

    @if($liveNews->isEmpty())
        <div class="text-center py-24 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm">
            <div class="text-6xl mb-4">📡</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Tidak ada siaran live saat ini</h3>
            <p class="text-gray-400 text-sm mb-6">Tidak ada kejadian live yang sedang berlangsung. Cek lagi nanti!</p>
            <a href="{{ route('top-news') }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-6 rounded-xl transition-colors text-sm">
                🏠 Kembali ke Home
            </a>
        </div>
    @else

        {{-- Top Live Story --}}
        @if($liveNews->first())
        <div class="mb-8">
            <div class="section-title">
                <h2 class="text-xl font-black text-gray-900 dark:text-white flex items-center gap-2">
                    <span class="live-dot"></span> Liputan Utama
                </h2>
            </div>
            <x-news-hero :hero="$liveNews->first()" />
        </div>
        @endif

        {{-- All Live News Grid --}}
        <div class="section-title mt-8">
            <h2 class="text-xl font-black text-gray-900 dark:text-white">Semua Berita Live</h2>
            <span class="ml-auto text-xs text-gray-400 font-semibold">{{ $liveNews->total() }} siaran</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($liveNews->skip(1) as $item)
                <x-news-card :item="$item" />
            @endforeach
        </div>

        @if($liveNews->hasPages())
        <div class="mt-10 flex justify-center">
            {{ $liveNews->links() }}
        </div>
        @endif

    @endif
</div>

<script>
// Live clock
function updateClock() {
    const el = document.getElementById('live-clock');
    if (!el) return;
    const now = new Date();
    el.textContent = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) + ' WIB';
}
updateClock();
setInterval(updateClock, 1000);
</script>
@endsection
