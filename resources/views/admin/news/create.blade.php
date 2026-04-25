@extends('layouts.app')
@section('title', 'Tulis Berita Baru — Top In News Admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-black text-gray-900 dark:text-white">✍️ Tulis Berita Baru</h1>
            <p class="text-gray-400 text-sm mt-0.5">Buat artikel berita yang menarik dan informatif</p>
        </div>
        <a href="{{ route('admin.news.index') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 text-sm font-semibold transition-all">
            ← Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 p-4 rounded-xl mb-6">
        <ul class="list-disc list-inside text-sm space-y-1">
            @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- MAIN CONTENT --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Title --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-5 shadow-sm">
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Judul Berita *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        placeholder="Tulis judul berita yang menarik..."
                        class="w-full text-xl font-bold text-gray-900 dark:text-white bg-transparent border-none outline-none placeholder-gray-300 dark:placeholder-gray-600 resize-none leading-snug">
                </div>

                {{-- Excerpt / Description --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-5 shadow-sm">
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Ringkasan / Excerpt *</label>
                    <textarea name="description" rows="3" required
                        placeholder="Tulis ringkasan singkat artikel (ditampilkan di homepage & SEO)..."
                        class="w-full text-sm text-gray-700 dark:text-gray-300 bg-transparent border-none outline-none placeholder-gray-300 dark:placeholder-gray-600 resize-none leading-relaxed">{{ old('description') }}</textarea>
                </div>

                {{-- Content (Quill) --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                    <div class="px-5 pt-4 pb-2 border-b border-gray-100 dark:border-gray-800">
                        <label class="text-xs font-black uppercase tracking-widest text-gray-400">Konten Artikel (Rich Text)</label>
                    </div>
                    <div id="quill-editor" style="min-height: 350px; font-size: 1rem;"></div>
                    <input type="hidden" name="content" id="content-input">
                </div>
            </div>

            {{-- SIDEBAR OPTIONS --}}
            <div class="space-y-4">

                {{-- Publish Box --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-5 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-widest text-gray-400 mb-4">Publikasi</p>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status" class="text-sm font-bold px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500">
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>✅ Published</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>📝 Draft</option>
                            </select>
                        </div>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_live" value="1" {{ old('is_live') ? 'checked' : '' }} class="w-4 h-4 text-red-600 rounded border-gray-300 focus:ring-red-500">
                            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 flex items-center gap-1.5"><span class="live-dot w-1.5 h-1.5"></span> Live / Breaking</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_trending" value="1" {{ old('is_trending') ? 'checked' : '' }} class="w-4 h-4 text-amber-500 rounded border-gray-300 focus:ring-amber-500">
                            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">🔥 Trending</span>
                        </label>
                    </div>
                    <button type="submit" class="w-full mt-5 bg-red-600 hover:bg-red-700 text-white font-black py-3 rounded-xl transition-all shadow-lg shadow-red-600/25 text-sm">
                        🚀 Publikasikan Sekarang
                    </button>
                </div>

                {{-- Category --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-5 shadow-sm">
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Kategori *</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach(['Technology','Business','Lifestyle','Sports','Health','Politics','Entertainment','Science'] as $cat)
                        <label class="flex items-center gap-2 cursor-pointer p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            <input type="radio" name="category" value="{{ $cat }}" {{ old('category') == $cat ? 'checked' : '' }} class="text-red-600 focus:ring-red-500">
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">{{ $cat }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Featured Image --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-5 shadow-sm">
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Gambar Utama</label>
                    <div id="image-preview" class="mb-3 hidden">
                        <img id="preview-img" src="" class="w-full h-36 object-cover rounded-xl" alt="Preview">
                    </div>
                    <label for="image-upload" class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-xl cursor-pointer hover:border-red-400 dark:hover:border-red-500 transition-colors bg-gray-50 dark:bg-gray-800 hover:bg-red-50 dark:hover:bg-red-900/10">
                        <svg class="w-8 h-8 text-gray-300 dark:text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-xs text-gray-400 font-semibold">Klik untuk upload gambar</span>
                        <span class="text-[10px] text-gray-300 dark:text-gray-600 mt-0.5">JPG, PNG, WebP — Maks 5MB</span>
                    </label>
                    <input type="file" id="image-upload" name="image_file" accept="image/*" class="hidden">
                    <p class="text-[10px] text-gray-400 mt-2 text-center">Atau gunakan URL:</p>
                    <input type="url" name="image" value="{{ old('image') }}" placeholder="https://..." class="mt-1 w-full text-xs px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
            </div>
        </div>
    </form>
</div>

{{-- Quill.js CDN --}}
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
// Quill Editor
const quill = new Quill('#quill-editor', {
    theme: 'snow',
    placeholder: 'Tulis konten artikel lengkap di sini...',
    modules: {
        toolbar: [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['blockquote', 'code-block'],
            ['link', 'image'],
            ['clean']
        ]
    }
});

// Dark mode styling for Quill
if (document.documentElement.classList.contains('dark')) {
    document.querySelector('.ql-toolbar').style.background = '#111827';
    document.querySelector('.ql-toolbar').style.borderColor = '#1f2937';
    document.querySelector('.ql-container').style.background = '#111827';
    document.querySelector('.ql-container').style.borderColor = '#1f2937';
    document.querySelector('.ql-editor').style.color = '#f9fafb';
}

// Submit: copy Quill HTML to hidden input
document.querySelector('form').addEventListener('submit', function () {
    document.getElementById('content-input').value = quill.root.innerHTML;
});

// Image preview
document.getElementById('image-upload').addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
