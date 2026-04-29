@extends('layouts.app')
@section('title', 'Admin Dashboard — Top In News')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-7xl">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2">
                    ⚙️ Admin Dashboard
                </h1>
                <p class="text-gray-400 text-sm mt-0.5">Kelola seluruh konten Top In News</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.subscribers.index') }}"
                    class="flex items-center gap-2 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400 dark:hover:bg-indigo-800/50 font-bold py-2.5 px-4 rounded-xl transition-all shadow-sm text-sm">
                    📬 Subscribers
                </a>
                <a href="{{ route('admin.ads.index') }}"
                    class="flex items-center gap-2 bg-blue-100 hover:bg-blue-200 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-800/50 font-bold py-2.5 px-4 rounded-xl transition-all shadow-sm text-sm">
                    📢 Kelola Iklan
                </a>
                <a href="{{ route('admin.news.create') }}"
                    class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-lg shadow-red-600/25 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Tulis Berita Baru
                </a>
            </div>
        </div>

        {{-- Stats Cards --}}
        @php
            $totalNews = \App\Models\News::count();
            $published = \App\Models\News::where('status', 'published')->count();
            $totalViews = \App\Models\News::sum('views');
            $totalComments = \App\Models\Comment::count();
        @endphp
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-100 dark:border-gray-800 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">Total Berita</p>
                <p class="text-3xl font-black text-gray-900 dark:text-white">{{ number_format($totalNews) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-100 dark:border-gray-800 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-widest text-emerald-500 mb-1">Published</p>
                <p class="text-3xl font-black text-emerald-600">{{ number_format($published) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-100 dark:border-gray-800 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-widest text-blue-400 mb-1">Total Views</p>
                <p class="text-3xl font-black text-blue-600">{{ number_format($totalViews) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-100 dark:border-gray-800 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-widest text-amber-500 mb-1">Komentar</p>
                <p class="text-3xl font-black text-amber-600">{{ number_format($totalComments) }}</p>
            </div>
        </div>

        {{-- Filter & Search --}}
        <div
            class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-800">
                <h2 class="font-bold text-gray-900 dark:text-white text-sm">📋 Daftar Berita ({{ $news->total() }} total)
                </h2>
                <form action="{{ route('admin.news.index') }}" method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..."
                        class="text-sm px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500 w-48">
                    <select name="category"
                        class="text-sm px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">Semua Kategori</option>
                        @foreach(['Technology', 'Business', 'Lifestyle', 'Sports', 'Health', 'Politics', 'Entertainment', 'Science'] as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-bold transition-colors">Filter</button>
                    @if(request('search') || request('category'))
                        <a href="{{ route('admin.news.index') }}"
                            class="px-3 py-1.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-bold transition-colors">Reset</a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead
                        class="bg-gray-50 dark:bg-gray-800/50 text-xs font-black uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        <tr>
                            <th class="px-5 py-3 w-8">#</th>
                            <th class="px-5 py-3 w-16">Foto</th>
                            <th class="px-5 py-3">Judul</th>
                            <th class="px-5 py-3">Kategori</th>
                            <th class="px-5 py-3 text-right">Views</th>
                            <th class="px-5 py-3 text-center">Status</th>
                            <th class="px-5 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                        @forelse($news as $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors group">
                                <td class="px-5 py-3 text-gray-400 text-xs">
                                    {{ $loop->iteration + ($news->currentPage() - 1) * $news->perPage() }}</td>
                                <td class="px-5 py-3">
                                    <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" class="w-12 h-9 rounded-lg object-cover">
                                </td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('detail-news', $item->id) }}" target="_blank"
                                            class="font-semibold text-gray-900 dark:text-gray-100 hover:text-red-600 dark:hover:text-red-400 transition-colors line-clamp-1 max-w-xs">
                                            {{ $item->title }}
                                        </a>
                                        @if($item->is_live) <span
                                            class="shrink-0 text-[9px] bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 px-1.5 py-0.5 rounded font-black">LIVE</span>
                                        @endif
                                        @if($item->is_trending) <span
                                            class="shrink-0 text-[9px] bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 px-1.5 py-0.5 rounded font-black">TREND</span>
                                        @endif
                                    </div>
                                    <time
                                        class="text-xs text-gray-400 mt-0.5 block">{{ $item->created_at->format('d M Y, H:i') }}</time>
                                </td>
                                <td class="px-5 py-3">
                                    <span
                                        class="text-xs font-bold px-2.5 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">{{ $item->category }}</span>
                                </td>
                                <td class="px-5 py-3 text-right font-semibold text-gray-600 dark:text-gray-400 text-xs">
                                    {{ number_format($item->views) }}</td>
                                <td class="px-5 py-3 text-center">
                                    <form action="{{ route('admin.news.updateStatus', $item->id) }}" method="POST"
                                        id="sf-{{ $item->id }}">
                                        @csrf
                                        <select name="status" onchange="document.getElementById('sf-{{ $item->id }}').submit()"
                                            class="text-xs font-bold px-3 py-1 rounded-full cursor-pointer outline-none border-none {{ $item->status == 'published' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400' }}">
                                            <option value="draft" {{ $item->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ $item->status == 'published' ? 'selected' : '' }}>
                                                Published</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="{{ route('admin.news.edit', $item->id) }}"
                                            class="px-2.5 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 hover:bg-amber-200 rounded-lg text-xs font-bold transition-colors">Edit</a>
                                        <form action="{{ route('admin.news.delete', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus berita ini?')">
                                            @csrf
                                            <button
                                                class="px-2.5 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 hover:bg-red-200 rounded-lg text-xs font-bold transition-colors">Hapus</button>
                                        </form>
                                        <form action="{{ route('admin.news.toggle', $item->id) }}" method="POST">
                                            @csrf
                                            <button
                                                class="px-2.5 py-1 {{ $item->status == 'draft' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }} hover:opacity-80 rounded-lg text-xs font-bold transition-colors w-20">
                                                {{ $item->status == 'draft' ? 'Publish' : 'Unpublish' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-16 text-center text-gray-400">
                                    <p class="text-4xl mb-3">📭</p>
                                    <p class="font-semibold">Belum ada berita. <a href="{{ route('admin.news.create') }}"
                                            class="text-red-500 hover:underline">Buat sekarang</a></p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($news->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">
                    {{ $news->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection