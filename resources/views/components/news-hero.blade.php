@props(['hero'])

<a href="{{ route('detail-news', $hero->id) }}" class="group block relative rounded-2xl overflow-hidden shadow-2xl h-[380px] md:h-[500px]">

    <img src="https://picsum.photos/1200/600?random={{ $hero->id }}"
         alt="{{ $hero->title }}"
         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

    {{-- Multi-layer gradient --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/40 via-transparent to-transparent"></div>

    {{-- Content --}}
    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
        <div class="flex flex-wrap gap-2 mb-3">
            @if($hero->is_live)
                <span class="animate-blink bg-red-600 text-white text-xs font-black px-3 py-1 rounded-lg shadow-lg flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse inline-block"></span> LIVE
                </span>
            @endif
            @if($hero->is_trending)
                <span class="bg-amber-500 text-black text-xs font-black px-3 py-1 rounded-lg shadow-lg">🔥 TRENDING</span>
            @endif
            <span class="bg-red-700/80 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded-lg uppercase tracking-wider">{{ $hero->category }}</span>
        </div>

        <h2 class="text-2xl md:text-4xl font-black text-white leading-tight mb-3 group-hover:text-red-300 transition-colors duration-300" style="font-family: 'Playfair Display', serif; text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
            {{ $hero->title }}
        </h2>

        <p class="text-gray-200 text-sm md:text-base line-clamp-2 hidden md:block max-w-2xl leading-relaxed opacity-90">
            {{ Str::limit(strip_tags($hero->description), 160) }}
        </p>

        <div class="mt-4 flex items-center gap-4 text-gray-300 text-xs font-medium">
            <time class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $hero->created_at->diffForHumans() }}
            </time>
            <span class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                {{ number_format($hero->views) }} views
            </span>
            <span class="ml-auto bg-white/20 backdrop-blur-sm text-white text-xs font-bold px-4 py-1.5 rounded-full group-hover:bg-red-600 transition-colors duration-300">
                Baca Selengkapnya →
            </span>
        </div>
    </div>
</a>
