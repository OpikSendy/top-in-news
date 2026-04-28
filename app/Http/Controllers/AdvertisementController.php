<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index()
    {
        $ads = \App\Models\Advertisement::latest()->paginate(10);
        return view('admin.ads.index', compact('ads'));
    }

    public function create()
    {
        return view('admin.ads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'partner_name' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_url' => 'nullable|url',
            'placement' => 'required|in:header,sidebar,in_article',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $imagePath = $request->file('image')->store('ads', 'public');

        \App\Models\Advertisement::create([
            'title' => $request->title,
            'partner_name' => $request->partner_name,
            'image_url' => '/storage/' . $imagePath,
            'link_url' => $request->link_url,
            'placement' => $request->placement,
            'is_active' => $request->has('is_active'),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('admin.ads.index')->with('success', 'Advertisement created successfully.');
    }

    public function edit($id)
    {
        $ad = \App\Models\Advertisement::findOrFail($id);
        return view('admin.ads.edit', compact('ad'));
    }

    public function update(Request $request, $id)
    {
        $ad = \App\Models\Advertisement::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'partner_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_url' => 'nullable|url',
            'placement' => 'required|in:header,sidebar,in_article',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $data = [
            'title' => $request->title,
            'partner_name' => $request->partner_name,
            'link_url' => $request->link_url,
            'placement' => $request->placement,
            'is_active' => $request->has('is_active'),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ads', 'public');
            $data['image_url'] = '/storage/' . $imagePath;
        }

        $ad->update($data);

        return redirect()->route('admin.ads.index')->with('success', 'Advertisement updated successfully.');
    }

    public function updatePosisi(Request $request, $id)
    {
        $ad = \App\Models\Advertisement::findOrFail($id);

        $request->validate([
            'placement' => 'required|in:header,sidebar,in_article',
        ]);

        $ad->placement = $request->placement;
        $ad->save();

        return redirect()->route('admin.ads.index')->with('success', 'Advertisement position updated successfully.');
    }

    public function destroy($id)
    {
        $ad = \App\Models\Advertisement::findOrFail($id);
        $ad->delete();

        return redirect()->route('admin.ads.index')->with('success', 'Advertisement deleted successfully.');
    }

    public function toggle($id)
    {
        $ad = \App\Models\Advertisement::findOrFail($id);
        $ad->update(['is_active' => !$ad->is_active]);

        return redirect()->route('admin.ads.index')->with('success', 'Advertisement status updated.');
    }

    public function trackClick($id)
    {
        $ad = \App\Models\Advertisement::findOrFail($id);
        $ad->increment('clicks');

        if ($ad->link_url) {
            return redirect()->away($ad->link_url);
        }

        return redirect()->back();
    }
}
