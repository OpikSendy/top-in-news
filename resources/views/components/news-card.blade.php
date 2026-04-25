@props(['item'])

<a href="{{ route('detail-news', $item->id) }}" class="news-card group flex flex-col bg-white dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800 shadow-sm">

    {{-- Image --}}
    <div class="relative overflow-hidden aspect-video">
        <img src="https://picsum.photos/400/250?random={{ $item->id }}"
             alt="{{ $item->title }}"
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
             loading="lazy">

        {{-- Gradient overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

        {{-- Badges --}}
        <div class="absolute top-3 left-3 flex gap-1.5 flex-wrap">
            @if($item->is_live)
                <span class="animate-blink bg-red-600 text-white text-[10px] font-black px-2 py-0.5 rounded-md tracking-wider shadow-lg">LIVE</span>
            @endif
            @if($item->is_trending)
                <span class="bg-amber-500 text-black text-[10px] font-black px-2 py-0.5 rounded-md shadow-lg">🔥 TRENDING</span>
            @endif
        </div>

        {{-- Views badge --}}
        <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
            <span class="bg-black/60 text-white text-[10px] font-semibold px-2 py-0.5 rounded-full backdrop-blur-sm flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                {{ number_format($item->views) }}
            </span>
        </div>
    </div>

    {{-- Content --}}
    <div class="p-4 flex flex-col flex-grow">
        {{-- Category --}}
        <div class="mb-2.5">
            <span class="text-[11px] font-black uppercase tracking-widest text-red-500 dark:text-red-400">{{ $item->category }}</span>
        </div>

        {{-- Title --}}
        <h3 class="font-bold text-gray-900 dark:text-white text-base leading-snug line-clamp-2 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors duration-200">
            {{ $item->title }}
        </h3>

        @if($item->description)
        <p class="text-gray-500 dark:text-gray-400 text-xs leading-relaxed line-clamp-2 mt-1.5">
            {{ Str::limit(strip_tags($item->description), 80) }}
        </p>
        @endif

        {{-- Footer --}}
        <div class="mt-auto pt-3 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between text-xs text-gray-400 dark:text-gray-500">
            <time datetime="{{ $item->created_at }}" class="flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $item->created_at->diffForHumans() }}
            </time>
            @php $words = str_word_count(strip_tags($item->description ?? $item->title)); $readMin = max(1, ceil($words / 200)); @endphp
            <span class="flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                {{ $readMin }} min
            </span>
        </div>
    </div>
</a>
