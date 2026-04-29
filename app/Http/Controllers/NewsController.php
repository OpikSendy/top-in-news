<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::where('status', 'published');

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // CATEGORY
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $news = $query->latest()->paginate(12);

        $items = collect($news->items());

        $hero = $items->shift();
        $grid = $items;

        $trending = $this->getTrending();
        $breaking = News::where('is_live', 1)
            ->latest()
            ->take(5)
            ->get();
        $live = News::where('is_live', 1)
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get();
        $popular = $this->getPopular();

        return view('top-news', compact('news', 'hero', 'grid', 'trending', 'breaking', 'live', 'popular'));
    }
    // ===================== ALL NEWS =====================
    public function allNews(Request $request)
    {
        $query = News::query()->where('status', 'published');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // AJAX live search — return JSON
        if ($request->ajax() || $request->has('ajax')) {
            $results = $query->latest()->take(6)->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'category' => $item->category,
                    'image' => "https://picsum.photos/120/90?random={$item->id}",
                    'time' => $item->created_at->diffForHumans(),
                    'url' => route('detail-news', $item->id),
                ];
            });
            return response()->json(['results' => $results]);
        }

        // Sort
        if ($request->sort === 'popular') {
            $query->orderBy('views', 'desc');
        } else {
            $query->latest();
        }

        $news = $query->paginate(16);
        return view('all-news', compact('news'));
    }

    // ===================== CATEGORY =====================
    public function category($name)
    {
        $news = News::where('category', $name)
            ->where('status', 'published')
            ->latest()
            ->paginate(16);

        $hero = News::where('category', $name)->where('status', 'published')->orderBy('views', 'desc')->first();
        $sidebar = News::where('category', $name)->where('status', 'published')->orderBy('views', 'desc')->take(6)->get();

        return view('category-news', compact('news', 'hero', 'sidebar', 'name'));
    }

    // ===================== DETAIL =====================
    public function detail($id)
    {
        $news = News::findOrFail($id);

        if ($news->status !== 'published') {
            abort(404);
        }


        $news->increment('views');

        $trending = News::where('is_trending', 1)
            ->latest()
            ->take(5)
            ->get();

        $related = News::where('category', $news->category)
            ->where('id', '!=', $news->id)
            ->latest()
            ->take(5)
            ->get();
        $comments = Comment::where('news_id', $id)
            ->latest()
            ->get();



        return view('detail-news', compact('news', 'trending', 'related', 'comments'));
    }

    // ===================== STORE =====================
    // ===================== STORE =====================
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:500',
            'description' => 'required|string',
            'category' => 'required|string',
        ]);

        $imagePath = null;

        // 1. Cek jika ada File yang diupload manual
        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $imagePath = $request->file('image_file')->store('news-images', 'public');
        }
        // 2. Jika tidak ada file, cek apakah ada URL gambar (hasil scraping)
        elseif ($request->filled('image')) {
            $externalUrl = $request->input('image');

            // Cek apakah URL ini berasal dari storage kita sendiri atau luar
            if (Str::contains($externalUrl, asset('storage'))) {
                // Jika sudah URL lokal (sudah didownload saat scrape), ambil path-nya saja
                $imagePath = str_replace(asset('storage') . '/', '', $externalUrl);
            } else {
                // Jika URL luar, download dulu agar aman
                $downloadedPath = $this->downloadAndSaveImage($externalUrl, true); // true = return path only
                $imagePath = $downloadedPath ?: null;
            }
        }

        // 3. Jika tetap kosong, gunakan placeholder
        if (!$imagePath) {
            $imagePath = 'news-images/default-placeholder.jpg'; // Pastikan file ini ada atau biarkan null
        }

        $slug = Str::slug($request->title);
        $slugBase = $slug;
        $i = 1;
        while (News::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $i++;
        }

        News::create([
            'title' => $request->input('title'),
            'slug' => $slug,
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'image' => $imagePath, // Simpan PATH saja (news-images/nama.jpg)
            'category' => $request->input('category'),
            'type' => 'news',
            'status' => $request->input('status', 'published'),
            'views' => 0,
            'is_live' => $request->has('is_live') ? 1 : 0,
            'is_trending' => $request->has('is_trending') ? 1 : 0,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.news.index')->with('success', '✅ Berita berhasil dipublikasikan!');
    }

    // ===================== UPDATE =====================
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $imagePath = $news->image;
        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $uploaded = $request->file('image_file')->store('news-images', 'public');
            $imagePath = asset('storage/' . $uploaded);
        } elseif ($request->filled('image')) {
            $imagePath = $request->input('image'); // ← pakai input()
        }

        $news->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'content' => $request->input('content', $news->getRawOriginal('content')), // ← pakai input()
            'image' => $imagePath,
            'category' => $request->input('category'),
            'is_live' => $request->has('is_live') ? 1 : 0,
            'is_trending' => $request->has('is_trending') ? 1 : 0,
            'status' => $request->input('status', $news->status),
        ]);

        return redirect()->route('admin.news.index')->with('success', '✅ Berita berhasil diperbarui!');
    }

    public function updateStatus(Request $request, $id)
    {
        $news = News::findOrFail($id);

        // Validasi agar status yang masuk hanya 'draft' atau 'published'
        $request->validate([
            'status' => 'required|in:draft,published'
        ]);

        $news->status = $request->status;
        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'Status updated to ' . $request->status);
    }

    // ===================== LIVE =====================
    public function live()
    {
        $liveNews = News::where('is_live', 1)
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('live', compact('liveNews'));
    }

    // ===================== TRENDING =====================
    public function trending()
    {
        $news = News::where('is_trending', 1)
            ->where('status', 'published')
            ->orderBy('views', 'desc')
            ->paginate(12);

        return view('trending', compact('news'));
    }

    // ===================== ADMIN =====================
    public function create()
    {
        return view('admin.news.create');
    }

    // ===================== SCRAPE ARTICLE =====================
    public function scrapeArticle(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $url = $request->url;

        // Add User-Agent to avoid 403 Forbidden on some websites like Liputan6
        $context = stream_context_create([
            'http' => [
                'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\r\n"
            ]
        ]);

        $html = @file_get_contents($url, false, $context);

        if (!$html) {
            return response()->json(['error' => 'Gagal mengambil konten dari URL. Pastikan URL valid dan dapat diakses.'], 400);
        }

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        @$dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);

        // 1. Ambil Judul
        $title = '';
        $titleNode = $xpath->query('//meta[@property="og:title"]')->item(0);
        if ($titleNode) {
            $title = $titleNode->getAttribute('content');
        } else {
            $titleNodes = $dom->getElementsByTagName('title');
            if ($titleNodes->length > 0) {
                $title = $titleNodes->item(0)->textContent;
                // Bersihkan title (biasanya ada " - Nama Web")
                $titleParts = explode(' - ', $title);
                $title = trim($titleParts[0]);
            }
        }

        // 2. Ambil & Download Gambar ke Storage Lokal
        $image = '';
        $imageNode = $xpath->query('//meta[@property="og:image"]')->item(0);
        if ($imageNode) {
            $externalImageUrl = trim($imageNode->getAttribute('content'));
            if ($externalImageUrl) {
                // Download gambar dan simpan ke storage lokal
                $localImageUrl = $this->downloadAndSaveImage($externalImageUrl);
                $image = $localImageUrl ?: $externalImageUrl; // fallback ke URL asli jika download gagal
            }
        }

        // 3. Ambil Konten
        $content = '';
        $queries = [
            '//div[contains(@class, "read-page--content")]',
            '//div[contains(@class, "detail__body-text")]',
            '//div[contains(@class, "read__content")]',
            '//div[contains(@class, "detail__body")]',
            '//div[contains(@class, "txt-article")]',
            '//div[contains(@class, "article-content")]',
            '//div[contains(@class, "entry-content")]',
            '//div[contains(@class, "post-content")]',
            '//div[contains(@class, "content-article")]',
            '//article',
            '//main'
        ];

        $contentNode = null;
        foreach ($queries as $query) {
            $nodes = $xpath->query($query);
            if ($nodes && $nodes->length > 0) {
                $contentNode = $nodes->item(0);
                break;
            }
        }

        if ($contentNode) {
            // Hapus elemen yang tidak diinginkan seperti script, style, ad iframe, atau elemen yang sering berisi iklan/baca juga
            $elementsToRemove = $xpath->query('.//script | .//style | .//iframe | .//div[contains(@class, "baca-juga")] | .//div[contains(@class, "parallax")]', $contentNode);
            foreach ($elementsToRemove as $el) {
                $el->parentNode->removeChild($el);
            }

            // Hilangkan tag <a> (replace dengan teksnya saja)
            $links = $xpath->query('.//a', $contentNode);
            for ($i = $links->length - 1; $i >= 0; $i--) {
                $link = $links->item($i);
                $text = $dom->createTextNode($link->textContent);
                $link->parentNode->replaceChild($text, $link);
            }

            // Ambil innerHTML
            foreach ($contentNode->childNodes as $child) {
                $content .= $dom->saveHTML($child);
            }
        }

        return response()->json([
            'title' => trim($title),
            'image' => trim($image),
            'content' => trim($content)
        ]);
    }

    // ===================== HELPER: DOWNLOAD & SIMPAN GAMBAR =====================
    private function downloadAndSaveImage(string $imageUrl, $returnPathOnly = false): ?string
    {
        if (filter_var($imageUrl, FILTER_VALIDATE_URL) === FALSE)
            return null;

        try {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 10,
                    'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36\r\n"
                ],
                'ssl' => ["verify_peer" => false, "verify_peer_name" => false]
            ]);

            $imageData = @file_get_contents($imageUrl, false, $context);
            if (!$imageData)
                return null;

            // Ambil info nama file dari URL untuk menebak ekstensi
            $info = pathinfo(parse_url($imageUrl, PHP_URL_PATH));
            $ext = isset($info['extension']) ? $info['extension'] : 'jpg';
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif']))
                $ext = 'jpg';

            $filename = 'scraped-' . time() . '-' . Str::random(10) . '.' . $ext;
            $path = 'news-images/' . $filename;

            Storage::disk('public')->put($path, $imageData);

            return $returnPathOnly ? $path : asset('storage/' . $path);

        } catch (\Throwable $e) {
            return null;
        }
    }

    public function adminIndex(Request $request)
    {
        $query = News::query();
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        $news = $query->latest()->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function delete($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect('/admin/news')->with('success', 'News deleted successfully');
    }

    public function toggle($id)
    {
        $news = News::findOrFail($id);

        $news->status = $news->status == 'draft' ? 'published' : 'draft';
        $news->save();

        return redirect('/admin/news')->with('success', 'Status updated!');
    }
    public function comment(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'comment' => 'required',
        ]);

        Comment::create([
            'news_id' => $id,
            'name' => $request->name,
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Comment added!');
    }
    public function getTrending()
    {
        return News::where('status', 'published')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
    }
    private function getPopular()
    {
        return News::where('status', 'published')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
    }


}