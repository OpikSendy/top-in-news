<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Comment;
use Illuminate\Support\Str;

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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:500',
            'description' => 'required|string',
            'category' => 'required|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $imagePath = $request->file('image_file')->store('news-images', 'public');
            $imagePath = asset('storage/' . $imagePath);
        } elseif ($request->filled('image')) {
            $imagePath = $request->input('image'); // ← pakai input()
        } else {
            $imagePath = 'https://picsum.photos/800/500?random=' . rand(1, 999);
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
            'content' => $request->input('content'), // ← pakai input(), bukan $request->content
            'image' => $imagePath,
            'category' => $request->input('category'),
            'type' => 'news',
            'status' => $request->input('status', 'published'),
            'views' => 0,
            'is_live' => $request->has('is_live') ? 1 : 0,
            'is_trending' => $request->has('is_trending') ? 1 : 0,
            'user_id' => null,
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