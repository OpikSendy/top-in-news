@extends('layouts.app')

@section('title', $news->title)
@section('meta_description', Str::limit(strip_tags($news->description), 155))
@section('og_type', 'article')
@section('og_image', "https://picsum.photos/1200/630?random={$news->id}")

@section('breaking')
    <span class="mx-4"><span class="text-red-300">•</span><a href="{{ route('detail-news', $news->id) }}"
            class="ml-2 hover:underline">{{ Str::limit($news->title, 80) }}</a></span>
@endsection

@section('structured_data')
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "NewsArticle",
      "headline": "{{ $news->title }}",
      "image": "https://picsum.photos/1200/630?random={{ $news->id }}",
      "datePublished": "{{ $news->created_at->toISOString() }}",
      "dateModified": "{{ $news->updated_at->toISOString() }}",
      "articleSection": "{{ $news->category }}"
    }
    </script>
@endsection

@section('content')

    @php
        $words = str_word_count(strip_tags(($news->content ?? '') . ' ' . ($news->description ?? '')));
        $readMin = max(1, ceil($words / 200));
    @endphp

    {{-- Reading Progress Bar (activated by JS) --}}
    <script>document.getElementById('reading-progress').style.display = 'block';</script>

    <div class="container mx-auto px-4 py-8 max-w-7xl">

        {{-- ===== BREADCRUMB ===== --}}
        <nav class="flex items-center gap-2 text-xs text-gray-400 dark:text-gray-500 mb-6">
            <a href="{{ route('top-news') }}" class="hover:text-red-500 transition-colors">Home</a>
            <span>›</span>
            <a href="{{ route('category', $news->category) }}"
                class="hover:text-red-500 transition-colors">{{ $news->category }}</a>
            <span>›</span>
            <span class="text-gray-600 dark:text-gray-400 line-clamp-1">{{ Str::limit($news->title, 50) }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- ===== MAIN ARTICLE ===== --}}
            <article class="lg:col-span-2" id="article-content">

                {{-- Header --}}
                <header class="mb-6">
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <a href="{{ route('category', $news->category) }}"
                            class="bg-red-600 hover:bg-red-700 text-white text-xs font-black px-3 py-1.5 rounded-lg uppercase tracking-wider transition-colors">
                            {{ $news->category }}
                        </a>
                        @if($news->is_live)
                            <span
                                class="animate-blink bg-red-600 text-white text-xs font-black px-3 py-1.5 rounded-lg flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse inline-block"></span> LIVE
                            </span>
                        @endif
                        @if($news->is_trending)
                            <span class="bg-amber-500 text-black text-xs font-black px-3 py-1.5 rounded-lg">🔥 Trending</span>
                        @endif
                    </div>

                    <h1 class="text-3xl md:text-4xl font-black text-gray-900 dark:text-white leading-tight mb-4"
                        style="font-family: 'Playfair Display', serif;">
                        {{ $news->title }}
                    </h1>

                    {{-- Meta --}}
                    <div
                        class="flex flex-wrap items-center gap-4 text-sm text-gray-400 dark:text-gray-500 pb-5 border-b border-gray-100 dark:border-gray-800">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <time datetime="{{ $news->created_at }}">{{ $news->created_at->format('d M Y, H:i') }}
                                WIB</time>
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span id="view-count">{{ number_format($news->views) }} views</span>
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            {{ $readMin }} menit baca
                        </span>
                    </div>

                    {{-- Action Bar --}}
                    <div class="flex items-center flex-wrap gap-2 pt-4">
                        {{-- Share Buttons --}}
                        <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . url()->current()) }}" target="_blank"
                            class="share-btn share-btn-wa">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                            WhatsApp
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($news->title) }}&url={{ urlencode(url()->current()) }}"
                            target="_blank" class="share-btn share-btn-x">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                            X
                        </a>
                        <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($news->title) }}"
                            target="_blank" class="share-btn share-btn-tg">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
                            </svg>
                            Telegram
                        </a>
                        <button onclick="copyLink()" class="share-btn share-btn-copy">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            <span id="copy-label">Salin Link</span>
                        </button>

                        {{-- Bookmark --}}
                        <button id="bookmark-btn"
                            onclick="toggleBookmark({{ $news->id }}, '{{ addslashes($news->title) }}')"
                            class="bookmark-btn flex items-center gap-1.5 px-3 py-2 rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-amber-50 dark:hover:bg-amber-900/20 text-gray-600 dark:text-gray-400 text-sm font-semibold transition-all border border-gray-200 dark:border-gray-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                            <span id="bm-label">Simpan</span>
                        </button>

                        {{-- TTS --}}
                        <button id="tts-btn" onclick="toggleTTS()"
                            class="flex items-center gap-1.5 px-3 py-2 rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-blue-900/20 text-gray-600 dark:text-gray-400 text-sm font-semibold transition-all border border-gray-200 dark:border-gray-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.536 8.464a5 5 0 010 7.072M12 6a7 7 0 010 12M9 9a3 3 0 000 6" />
                            </svg>
                            <span id="tts-label">Dengarkan</span>
                        </button>
                    </div>
                </header>

                {{-- Hero Image --}}
                <figure class="mb-8 rounded-2xl overflow-hidden shadow-xl">
                    <img src="https://picsum.photos/900/500?random={{ $news->id }}" alt="{{ $news->title }}"
                        class="w-full h-auto object-cover max-h-[500px]">
                    <figcaption class="text-xs text-gray-400 text-center py-2 px-4 bg-gray-50 dark:bg-gray-900">
                        Foto: Ilustrasi — {{ $news->category }} / Top In News
                    </figcaption>
                </figure>

                {{-- Article Summary --}}
                @if($news->description)
                    <div class="summary-box mb-8">
                        <p class="text-xs font-black uppercase tracking-widest text-red-500 mb-2">📋 Ringkasan Artikel</p>
                        <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed font-medium">
                            {{ Str::limit(strip_tags($news->description), 300) }}
                        </p>
                    </div>
                @endif

                {{-- Article Body --}}
                <div class="article-content" id="tts-content">
                    @if($news->content)
                        {!! $news->content !!}
                    @elseif($news->description)
                        {!! nl2br(e($news->description)) !!}
                    @else
                        <p class="text-gray-500">Konten artikel belum tersedia.</p>
                    @endif
                </div>

                {{-- Tags --}}
                <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-800">
                    <p class="text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Tags</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach(array_filter([strtolower($news->category), 'berita', 'top-in-news']) as $tag)
                            <a href="{{ route('top-news', ['search' => $tag]) }}"
                                class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 text-xs font-semibold hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-colors border border-gray-200 dark:border-gray-700">
                                #{{ $tag }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <hr class="my-10 border-gray-100 dark:border-gray-800">

                {{-- ===== COMMENTS ===== --}}
                <section id="comments">
                    <h3 class="text-xl font-black text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                        💬 Komentar <span class="text-base font-bold text-gray-400">({{ $comments->count() }})</span>
                    </h3>

                    <div
                        class="bg-gray-50 dark:bg-gray-900 p-6 rounded-2xl border border-gray-100 dark:border-gray-800 mb-8">
                        <form method="POST" action="{{ route('comment.store', $news->id) }}">
                            @csrf
                            <div class="space-y-3">
                                <input type="text" name="name" placeholder="Nama kamu" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500 text-sm">
                                <textarea name="comment" placeholder="Tulis komentar..." rows="3" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500 text-sm resize-none"></textarea>
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-red-600/20">
                                        Kirim Komentar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="space-y-4">
                        @forelse($comments as $c)
                            <div
                                class="flex gap-4 p-4 bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm">
                                <div
                                    class="shrink-0 w-11 h-11 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center font-black text-white text-base shadow-md">
                                    {{ strtoupper(substr($c->name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <strong class="text-gray-900 dark:text-white text-sm font-bold">{{ $c->name }}</strong>
                                        <time class="text-xs text-gray-400">{{ $c->created_at->diffForHumans() }}</time>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">{{ $c->comment }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <p class="text-sm font-medium">Belum ada komentar. Jadilah yang pertama!</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </article>

            {{-- ===== SIDEBAR ===== --}}
            <aside class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">

                    {{-- Trending --}}
                    <div
                        class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                        <div class="bg-gradient-to-r from-red-600 to-red-700 px-4 py-3">
                            <h4 class="text-white font-black text-sm uppercase tracking-wide">🔥 Trending Sekarang</h4>
                        </div>
                        <div class="p-2 divide-y divide-gray-50 dark:divide-gray-800">
                            @foreach($trending as $item)
                                <x-news-mini :item="$item" />
                            @endforeach
                        </div>
                    </div>

                    {{-- Related --}}
                    @if($related->count() > 0)
                        <div
                            class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                            <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-4 py-3">
                                <h4 class="text-white font-black text-sm uppercase tracking-wide">📰 Berita Terkait</h4>
                            </div>
                            <div class="p-4 space-y-4">
                                @foreach($related as $item)
                                    <a href="{{ route('detail-news', $item->id) }}" class="group block">
                                        <div class="overflow-hidden rounded-xl mb-2 aspect-video bg-gray-100 dark:bg-gray-800">
                                            <img src="https://picsum.photos/400/200?random={{ $item->id }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                                loading="lazy" alt="{{ $item->title }}">
                                        </div>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-widest text-red-500 block mb-0.5">{{ $item->category }}</span>
                                        <h5
                                            class="font-bold text-sm text-gray-900 dark:text-gray-100 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors line-clamp-2 leading-snug">
                                            {{ Str::limit($item->title, 70) }}
                                        </h5>
                                        <time
                                            class="text-xs text-gray-400 mt-1 block">{{ $item->created_at->diffForHumans() }}</time>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </aside>
        </div>
    </div>

    <script>
        // Reading Progress
        window.addEventListener('scroll', function () {
            const article = document.getElementById('article-content');
            if (!article) return;
            const bar = document.getElementById('reading-progress');
            const articleTop = article.offsetTop;
            const articleH = article.offsetHeight;
            const winH = window.innerHeight;
            const scrolled = window.scrollY;
            const progress = Math.min(100, Math.max(0, ((scrolled - articleTop + winH) / articleH) * 100));
            if (bar) bar.style.width = progress + '%';
        });

        // Copy Link
        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                const label = document.getElementById('copy-label');
                label.textContent = '✓ Tersalin!';
                setTimeout(() => label.textContent = 'Salin Link', 2000);
            });
        }

        // Bookmark
        function toggleBookmark(id, title) {
            let bm = JSON.parse(localStorage.getItem('topinnews_bookmarks') || '[]');
            const idx = bm.findIndex(b => b.id === id);
            const btn = document.getElementById('bookmark-btn');
            const label = document.getElementById('bm-label');
            if (idx > -1) {
                bm.splice(idx, 1);
                btn.classList.remove('bookmarked');
                label.textContent = 'Simpan';
            } else {
                bm.push({ id, title, url: window.location.href, savedAt: Date.now() });
                btn.classList.add('bookmarked');
                label.textContent = '✓ Tersimpan';
            }
            localStorage.setItem('topinnews_bookmarks', JSON.stringify(bm));
        }

        // Init bookmark state
        (function () {
            const id = {{ $news->id }};
            const bm = JSON.parse(localStorage.getItem('topinnews_bookmarks') || '[]');
            if (bm.find(b => b.id === id)) {
                document.getElementById('bookmark-btn')?.classList.add('bookmarked');
                const lbl = document.getElementById('bm-label');
                if (lbl) lbl.textContent = '✓ Tersimpan';
            }
        })();

        // TTS
        let ttsUtterance = null;
        let ttsSpeaking = false;
        function toggleTTS() {
            const btn = document.getElementById('tts-btn');
            const label = document.getElementById('tts-label');
            const content = document.getElementById('tts-content');
            if (!('speechSynthesis' in window)) { alert('Browser tidak mendukung Text-to-Speech'); return; }
            if (ttsSpeaking) {
                window.speechSynthesis.cancel();
                ttsSpeaking = false;
                label.textContent = 'Dengarkan';
                btn.classList.remove('!bg-blue-600', '!text-white');
                return;
            }
            const text = content ? content.innerText : '';
            ttsUtterance = new SpeechSynthesisUtterance(text);
            ttsUtterance.lang = 'id-ID';
            ttsUtterance.rate = 0.9;
            ttsUtterance.onend = () => {
                ttsSpeaking = false;
                label.textContent = 'Dengarkan';
                btn.classList.remove('!bg-blue-600', '!text-white');
            };
            window.speechSynthesis.speak(ttsUtterance);
            ttsSpeaking = true;
            label.textContent = '⏸ Stop';
            btn.classList.add('!bg-blue-600', '!text-white');
        }
    </script>

@endsection