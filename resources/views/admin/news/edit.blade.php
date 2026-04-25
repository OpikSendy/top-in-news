@extends('layouts.app')
@section('title', 'Edit Berita — Admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-black text-gray-900 dark:text-white">✏️ Edit Berita</h1>
        <div class="flex gap-2">
            <a href="{{ route('detail-news', $news->id) }}" target="_blank" class="px-4 py-2 rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-sm font-semibold">👁 Preview</a>
            <a href="{{ route('admin.news.index') }}" class="px-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 text-sm font-semibold">← Kembali</a>
        </div>
    </div>

    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-5">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-5 shadow-sm">
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Judul *</label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" required class="w-full text-xl font-bold text-gray-900 dark:text-white bg-transparent border-none outline-none">
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-5 shadow-sm">
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Ringkasan *</label>
                    <textarea name="description" rows="3" required class="w-full text-sm text-gray-700 dark:text-gray-300 bg-transparent border-none outline-none resize-none leading-relaxed">{{ old('description', $news->description) }}</textarea>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                    <div class="px-5 py-3 border-b border-gray-100 dark:border-gray-800">
                        <label class="text-xs font-black uppercase tracking-widest text-gray-400">Konten Artikel (Rich Text)</label>
                    </div>
                    <div id="quill-editor" style="min-height:320px"></div>
                    <input type="hidden" name="content" id="content-input" value="{{ old('content', $news->content) }}">
                </div>
            </div>
            <div class="space-y-4">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-5 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-widest text-gray-400 mb-4">Publikasi</p>
                    <div class="space-y-3">
                        <select name="status" class="w-full text-sm font-bold px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="published" {{ $news->status == 'published' ? 'selected' : '' }}>✅ Published</option>
                            <option value="draft" {{ $news->status == 'draft' ? 'selected' : '' }}>📝 Draft</option>
                        </select>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_live" value="1" {{ $news->is_live ? 'checked' : '' }} class="w-4 h-4 text-red-600 rounded">
                            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">🔴 Live/Breaking</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_trending" value="1" {{ $news->is_trending ? 'checked' : '' }} class="w-4 h-4 text-amber-500 rounded">
                            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">🔥 Trending</span>
                        </label>
                    </div>
                    <button type="submit" class="w-full mt-4 bg-red-600 hover:bg-red-700 text-white font-black py-3 rounded-xl text-sm shadow-lg shadow-red-600/25 transition-all">💾 Simpan</button>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-5 shadow-sm">
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Kategori *</label>
                    <div class="grid grid-cols-2 gap-1.5">
                        @foreach(['Technology','Business','Lifestyle','Sports','Health','Politics','Entertainment','Science'] as $cat)
                        <label class="flex items-center gap-2 cursor-pointer p-1.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            <input type="radio" name="category" value="{{ $cat }}" {{ $news->category == $cat ? 'checked' : '' }} class="text-red-600">
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">{{ $cat }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-5 shadow-sm">
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Gambar</label>
                    @if($news->image)
                    <img src="{{ $news->image }}" class="w-full h-28 object-cover rounded-xl mb-3" onerror="this.src='https://picsum.photos/400/200?random={{ $news->id }}'">
                    @endif
                    <input type="file" name="image_file" accept="image/*" class="w-full text-xs text-gray-500 dark:text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-red-600 file:text-white file:text-xs file:font-bold file:cursor-pointer">
                    <input type="url" name="image" value="{{ old('image', $news->image) }}" placeholder="https://..." class="mt-2 w-full text-xs px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
            </div>
        </div>
    </form>
</div>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
const quill = new Quill('#quill-editor', {
    theme: 'snow',
    modules: { toolbar: [[{'header':[1,2,3,false]}],['bold','italic','underline'],['link','image'],['blockquote'],['clean']] }
});
const existing = document.getElementById('content-input').value;
if (existing) quill.clipboard.dangerouslyPasteHTML(existing);
document.querySelector('form').addEventListener('submit', () => {
    document.getElementById('content-input').value = quill.root.innerHTML;
});
</script>
@endsection
