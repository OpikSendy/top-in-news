@props(['item'])

<a href="{{ route('detail-news', $item->id) }}" class="group flex gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/60 transition-all duration-200">

    {{-- Thumbnail --}}
    <div class="shrink-0 w-20 h-16 rounded-lg overflow-hidden relative">
        <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}"
             alt="{{ $item->title }}"
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
             loading="lazy">
        @if($item->is_live)
            <div class="absolute inset-0 flex items-start justify-start p-1">
                <span class="flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                </span>
            </div>
        @endif
    </div>

    {{-- Text --}}
    <div class="flex flex-col justify-between flex-1 min-w-0 py-0.5">
        <div>
            <span class="text-[10px] font-black uppercase tracking-widest text-red-500 dark:text-red-400 block mb-1">
                @if($item->is_trending) 🔥 @endif {{ $item->category }}
            </span>
            <h4 class="font-bold text-sm text-gray-900 dark:text-gray-100 leading-snug line-clamp-2 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors duration-200">
                {{ $item->title }}
            </h4>
        </div>
        <time class="text-[11px] text-gray-400 dark:text-gray-500 flex items-center gap-1 mt-1">
            <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ $item->created_at->diffForHumans() }}
        </time>
    </div>
</a>
