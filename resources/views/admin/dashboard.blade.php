@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="text-sm text-slate-500">Produk</div>
            <div class="mt-4 text-3xl font-black text-slate-900">{{ $stats['products'] }}</div>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="text-sm text-slate-500">Kategori</div>
            <div class="mt-4 text-3xl font-black text-slate-900">{{ $stats['categories'] }}</div>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="text-sm text-slate-500">Pesanan</div>
            <div class="mt-4 text-3xl font-black text-slate-900">{{ $stats['orders'] }}</div>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="text-sm text-slate-500">Pelanggan</div>
            <div class="mt-4 text-3xl font-black text-slate-900">{{ $stats['customers'] }}</div>
        </div>
    </div>

    <div class="mt-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900">Pesanan Terbaru</h2>
        <div class="mt-6 space-y-3">
            @foreach($recentOrders as $order)
                <div class="flex items-center justify-between rounded-xl border border-slate-200 p-4">
                    <div>
                        <div class="font-semibold text-slate-900">{{ $order->order_number }}</div>
                        <div class="text-sm text-slate-500">{{ $order->user?->name ?? 'Guest' }}</div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-slate-900">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                        <div class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ $order->status }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
