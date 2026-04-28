@extends('layouts.app')
@section('title', 'Manage Subscribers — Top In News')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-7xl">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2">
                📬 Daftar Subscribers
            </h1>
            <p class="text-gray-400 text-sm mt-0.5">Kelola email pengunjung yang berlangganan newsletter</p>
        </div>
        <div class="bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-400 font-bold px-4 py-2 rounded-xl border border-indigo-100 dark:border-indigo-800/50">
            Total: {{ $subscribers->total() }} email
        </div>
    </div>

    {{-- List --}}
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 dark:bg-gray-800/50 text-xs font-black uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    <tr>
                        <th class="px-5 py-3 w-8">#</th>
                        <th class="px-5 py-3">Alamat Email</th>
                        <th class="px-5 py-3">Tanggal Berlangganan</th>
                        <th class="px-5 py-3 text-center">Status</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @forelse($subscribers as $sub)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors group">
                        <td class="px-5 py-4 text-gray-400 text-xs">{{ $loop->iteration + ($subscribers->currentPage()-1) * $subscribers->perPage() }}</td>
                        <td class="px-5 py-4 font-semibold text-gray-900 dark:text-gray-100">
                            {{ $sub->email }}
                        </td>
                        <td class="px-5 py-4 text-gray-500 text-xs">
                            {{ $sub->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-5 py-4 text-center">
                            @if($sub->is_active)
                                <span class="px-2 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 rounded text-xs font-bold">Aktif</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 rounded text-xs font-bold">Berhenti</span>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                <form action="{{ route('admin.subscribers.toggle', $sub->id) }}" method="POST">
                                    @csrf
                                    <button class="px-2.5 py-1.5 {{ !$sub->is_active ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }} hover:opacity-80 rounded-lg text-xs font-bold transition-colors w-20">
                                        {{ !$sub->is_active ? 'Aktifkan' : 'Matikan' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.subscribers.delete', $sub->id) }}" method="POST" onsubmit="return confirm('Hapus email pelanggan ini secara permanen?')">
                                    @csrf
                                    <button class="px-2.5 py-1.5 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 hover:bg-red-200 rounded-lg text-xs font-bold transition-colors">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-16 text-center text-gray-400">
                            <p class="text-4xl mb-3">📭</p>
                            <p class="font-semibold">Belum ada email yang berlangganan newsletter.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($subscribers->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">
            {{ $subscribers->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
