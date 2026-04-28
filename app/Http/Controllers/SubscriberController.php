<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $existing = \App\Models\Subscriber::where('email', $request->email)->first();

        if ($existing) {
            return redirect()->back()->with('success', 'Email ini sudah terdaftar sebelumnya.');
        }

        \App\Models\Subscriber::create([
            'email' => $request->email,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Berhasil berlangganan newsletter!');
    }

    public function index()
    {
        $subscribers = \App\Models\Subscriber::latest()->paginate(20);
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function toggle($id)
    {
        $subscriber = \App\Models\Subscriber::findOrFail($id);
        $subscriber->update(['is_active' => !$subscriber->is_active]);

        return redirect()->back()->with('success', 'Status subscriber berhasil diubah.');
    }

    public function destroy($id)
    {
        $subscriber = \App\Models\Subscriber::findOrFail($id);
        $subscriber->delete();

        return redirect()->back()->with('success', 'Subscriber berhasil dihapus.');
    }
}
