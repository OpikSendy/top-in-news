<!DOCTYPE html>
<html lang="id" class="antialiased scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Top In News') | Portal Berita Terkini</title>
    <meta name="description" content="@yield('meta_description', 'Top In News — Berita terkini, terpercaya, dan terlengkap dari seluruh Indonesia dan dunia.')">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('title', 'Top In News')">
    <meta property="og:description" content="@yield('meta_description', 'Berita terkini, terpercaya, dan terlengkap.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Top In News">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Top In News')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;600;700;800&display=swap" rel="stylesheet">
    @yield('structured_data')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('scripts')
    <script>
        (function(){
            const t = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            t === 'dark' ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark');
        })();
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">

    {{-- Reading Progress Bar --}}
    <div id="reading-progress"></div>

    {{-- ===== TOP BAR ===== --}}
    <div class="topbar-gradient text-gray-300 text-xs py-2 hidden md:block">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span id="topbar-date" class="font-medium"></span>
                <span class="text-gray-600">|</span>
                <span class="text-red-400 font-semibold flex items-center gap-1.5">
                    <span class="live-dot"></span> LIVE NOW
                </span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-gray-400">Ikuti kami:</span>
                <a href="#" class="hover:text-white transition-colors">Instagram</a>
                <a href="#" class="hover:text-white transition-colors">X (Twitter)</a>
                <a href="#" class="hover:text-white transition-colors">YouTube</a>
                <a href="#" class="hover:text-white transition-colors">TikTok</a>
            </div>
        </div>
    </div>

    {{-- ===== NAVBAR ===== --}}
    <nav class="navbar-main sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">

                {{-- LOGO --}}
                <a href="{{ route('top-news') }}" class="flex items-center gap-3 group">
                    <div class="w-9 h-9 bg-gradient-to-br from-red-600 to-red-800 rounded-lg flex items-center justify-center shadow-lg shadow-red-900/30 group-hover:scale-110 transition-transform">
                        <span class="text-white text-lg font-black leading-none">T</span>
                    </div>
                    <div>
                        <span class="text-white font-black text-xl tracking-tight leading-none block">Top In News</span>
                        <span class="text-red-400 text-[10px] font-semibold tracking-widest uppercase">Portal Berita Terkini</span>
                    </div>
                </a>

                {{-- DESKTOP NAV --}}
                <div class="hidden lg:flex items-center gap-1 text-sm font-semibold text-gray-300">
                    <a href="{{ route('top-news') }}" class="px-3 py-2 rounded-lg hover:bg-white/10 hover:text-white transition-all {{ request()->is('top-news') ? 'text-white bg-white/10' : '' }}">Home</a>

                    {{-- Categories Mega Menu --}}
                    <div class="relative mega-menu-trigger">
                        <button class="px-3 py-2 rounded-lg hover:bg-white/10 hover:text-white transition-all flex items-center gap-1.5">
                            Kategori
                            <svg class="w-3.5 h-3.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="mega-menu">
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3">Semua Kategori</p>
                            <div class="grid grid-cols-4 gap-2">
                                @foreach([
                                    ['name'=>'Technology','icon'=>'💻','color'=>'bg-blue-600'],
                                    ['name'=>'Business','icon'=>'📈','color'=>'bg-emerald-600'],
                                    ['name'=>'Lifestyle','icon'=>'✨','color'=>'bg-violet-600'],
                                    ['name'=>'Sports','icon'=>'⚽','color'=>'bg-orange-500'],
                                    ['name'=>'Health','icon'=>'🏥','color'=>'bg-teal-600'],
                                    ['name'=>'Politics','icon'=>'🏛️','color'=>'bg-red-700'],
                                    ['name'=>'Entertainment','icon'=>'🎬','color'=>'bg-pink-600'],
                                    ['name'=>'Science','icon'=>'🔬','color'=>'bg-sky-600'],
                                ] as $cat)
                                    <a href="{{ route('category', $cat['name']) }}" class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-white/10 transition-all group text-center">
                                        <div class="{{ $cat['color'] }} w-10 h-10 rounded-xl flex items-center justify-center text-lg shadow-md group-hover:scale-110 transition-transform">{{ $cat['icon'] }}</div>
                                        <span class="text-xs font-semibold text-gray-300 group-hover:text-white">{{ $cat['name'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('live') }}" class="px-3 py-2 rounded-lg hover:bg-red-600/20 text-red-400 hover:text-red-300 transition-all flex items-center gap-1.5">
                        <span class="live-dot w-1.5 h-1.5"></span> Live
                    </a>
                    <a href="{{ route('trending') }}" class="px-3 py-2 rounded-lg hover:bg-white/10 hover:text-white transition-all">🔥 Trending</a>
                    <a href="{{ route('all-news') }}" class="px-3 py-2 rounded-lg hover:bg-white/10 hover:text-white transition-all">Semua Berita</a>
                </div>

                {{-- RIGHT SIDE --}}
                <div class="flex items-center gap-2">
                    {{-- Live Search --}}
                    <div class="relative hidden md:block" id="search-wrapper">
                        <div class="flex items-center bg-white/10 border border-white/10 rounded-xl overflow-hidden focus-within:border-red-500/50 focus-within:bg-white/15 transition-all">
                            <svg class="w-4 h-4 text-gray-400 ml-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" id="live-search-input" placeholder="Cari berita..." class="bg-transparent text-sm text-white placeholder-gray-400 px-3 py-2 w-48 focus:outline-none focus:w-64 transition-all duration-300" autocomplete="off">
                        </div>
                        <div id="search-results-dropdown" class="search-results-dropdown hidden"></div>
                    </div>

                    {{-- Dark Mode --}}
                    <button onclick="toggleDarkMode()" id="theme-btn" class="p-2.5 rounded-xl bg-white/10 hover:bg-white/20 transition-all duration-300 border border-white/10" title="Toggle Tema">
                        <svg id="icon-sun" class="w-4 h-4 text-yellow-400 hidden dark:block" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/></svg>
                        <svg id="icon-moon" class="w-4 h-4 text-gray-300 block dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
                    </button>

                    {{-- Admin --}}
                    <a href="{{ route('admin.news.index') }}" class="hidden sm:flex items-center gap-1.5 px-3 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-gray-300 hover:text-white text-xs font-semibold transition-all border border-white/10">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Admin
                    </a>

                    {{-- Mobile burger --}}
                    <button id="mobile-toggle" class="lg:hidden p-2.5 rounded-xl bg-white/10 hover:bg-white/20 transition-all border border-white/10" aria-label="Menu">
                        <svg id="burger-icon" class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg id="close-icon" class="w-5 h-5 text-white hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Nav --}}
        <div id="mobile-menu" class="hidden lg:hidden border-t border-white/10 bg-gray-900/98 backdrop-blur-xl">
            <div class="container mx-auto px-4 py-4 flex flex-col gap-1 text-sm font-semibold text-gray-300">
                <a href="{{ route('top-news') }}" class="flex items-center gap-2 py-2.5 px-3 rounded-xl hover:bg-white/10 hover:text-white transition-all">🏠 Home</a>
                <a href="{{ route('live') }}" class="flex items-center gap-2 py-2.5 px-3 rounded-xl hover:bg-red-600/20 text-red-400 transition-all">🔴 Live Coverage</a>
                <a href="{{ route('trending') }}" class="flex items-center gap-2 py-2.5 px-3 rounded-xl hover:bg-white/10 hover:text-white transition-all">🔥 Trending</a>
                <a href="{{ route('all-news') }}" class="flex items-center gap-2 py-2.5 px-3 rounded-xl hover:bg-white/10 hover:text-white transition-all">📰 Semua Berita</a>
                <hr class="border-white/10 my-2">
                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest px-3 pb-1">Kategori</p>
                @foreach(['Technology','Business','Lifestyle','Sports','Health','Politics','Entertainment','Science'] as $cat)
                    <a href="{{ route('category', $cat) }}" class="py-2 px-3 rounded-xl hover:bg-white/10 hover:text-white transition-all pl-5 text-xs">{{ $cat }}</a>
                @endforeach
                <hr class="border-white/10 my-2">
                <a href="{{ route('admin.news.index') }}" class="flex items-center gap-2 py-2.5 px-3 rounded-xl hover:bg-white/10 hover:text-white transition-all text-gray-400">⚙️ Admin Dashboard</a>
            </div>
        </div>
    </nav>

    {{-- ===== BREAKING TICKER ===== --}}
    @hasSection('breaking')
    <div class="bg-red-700 dark:bg-red-800 text-white py-2.5 overflow-hidden shadow-lg shadow-red-900/30">
        <div class="flex items-center">
            <div class="shrink-0 bg-red-900 text-white text-[10px] font-black px-4 py-1.5 uppercase tracking-widest flex items-center gap-1.5 z-10">
                <span class="live-dot"></span> Breaking
            </div>
            <div class="flex-1 overflow-hidden relative ml-3">
                <div class="ticker-track text-sm font-medium">
                    @yield('breaking')
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== FLASH MESSAGE ===== --}}
    @if(session('success'))
    <div id="flash-msg" class="fixed top-20 right-4 z-50 bg-emerald-600 text-white px-5 py-3 rounded-xl shadow-2xl flex items-center gap-3 text-sm font-semibold animate-fade-up">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
        <button onclick="this.parentElement.remove()" class="ml-2 opacity-70 hover:opacity-100">✕</button>
    </div>
    <script>setTimeout(()=>{ const f=document.getElementById('flash-msg'); if(f) f.remove(); }, 4000);</script>
    @endif

    {{-- ===== CONTENT ===== --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="footer-main text-gray-300 mt-16">
        <div class="container mx-auto px-4 pt-14 pb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-10">

                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-800 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-xl font-black">T</span>
                        </div>
                        <div>
                            <span class="text-white font-black text-lg leading-none block">Top In News</span>
                            <span class="text-red-400 text-[10px] font-semibold tracking-widest uppercase">Portal Berita Terkini</span>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed">Berita terkini, terpercaya, dan terlengkap dari seluruh Indonesia dan dunia. Hadir 24/7 untuk kamu.</p>
                    <div class="flex gap-3 mt-5">
                        @foreach(['IG','X','YT','TT'] as $s)
                        <a href="#" class="w-9 h-9 rounded-xl bg-white/10 hover:bg-red-600 flex items-center justify-center text-xs font-bold transition-all duration-300 hover:scale-110 border border-white/10">{{ $s }}</a>
                        @endforeach
                    </div>
                </div>

                {{-- Kategori --}}
                <div>
                    <h5 class="font-bold text-white text-sm uppercase tracking-wider mb-4 pb-2 border-b border-white/10">Kategori</h5>
                    <div class="grid grid-cols-2 gap-y-2 gap-x-4">
                        @foreach(['Technology','Business','Lifestyle','Sports','Health','Politics','Entertainment','Science'] as $cat)
                        <a href="{{ route('category', $cat) }}" class="text-gray-500 hover:text-red-400 text-sm transition-colors flex items-center gap-1.5">
                            <span class="w-1 h-1 bg-red-700 rounded-full"></span> {{ $cat }}
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h5 class="font-bold text-white text-sm uppercase tracking-wider mb-4 pb-2 border-b border-white/10">Quick Links</h5>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('live') }}" class="text-gray-500 hover:text-red-400 text-sm transition-colors flex items-center gap-2"><span class="live-dot w-1.5 h-1.5"></span> Live Coverage</a>
                        <a href="{{ route('trending') }}" class="text-gray-500 hover:text-red-400 text-sm transition-colors">🔥 Trending</a>
                        <a href="{{ route('all-news') }}" class="text-gray-500 hover:text-red-400 text-sm transition-colors">📰 Semua Berita</a>
                        <a href="{{ route('admin.news.index') }}" class="text-gray-600 hover:text-gray-400 text-sm transition-colors mt-2">⚙️ Admin</a>
                    </div>
                </div>

                {{-- Newsletter --}}
                <div>
                    <h5 class="font-bold text-white text-sm uppercase tracking-wider mb-4 pb-2 border-b border-white/10">Newsletter</h5>
                    <p class="text-gray-500 text-sm mb-4">Daftarkan email kamu untuk mendapat berita terpilih setiap hari.</p>
                    <div class="flex flex-col gap-2">
                        <input type="email" placeholder="email@kamu.com" class="bg-white/10 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-red-500 transition-colors">
                        <button class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold py-2.5 rounded-xl transition-colors">Langganan Gratis</button>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-gray-600">
                <p>© {{ date('Y') }} Top In News. Hak cipta dilindungi undang-undang.</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-gray-400 transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-gray-400 transition-colors">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-gray-400 transition-colors">Redaksi</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleDarkMode(){
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        // Topbar date
        const d = new Date();
        const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        const el = document.getElementById('topbar-date');
        if(el) el.textContent = `${days[d.getDay()]}, ${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;

        // Mobile menu
        const mobileToggle = document.getElementById('mobile-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const burgerIcon = document.getElementById('burger-icon');
        const closeIcon = document.getElementById('close-icon');
        if(mobileToggle){
            mobileToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                burgerIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>