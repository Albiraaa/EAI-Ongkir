@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
    <section class="section-shell py-12">
        <h1 class="text-4xl font-black text-slate-900">Pesanan Saya</h1>

        @if($orders->count())
            <div class="mt-8 space-y-4">
                @foreach($orders as $order)
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                            <div>
                                <div class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">{{ $order->order_number }}</div>
                                <div class="mt-2 text-xl font-bold text-slate-900">Total: Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="badge {{ $order->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($order->status === 'paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700') }}">{{ ucfirst($order->status) }}</span>
                                <a href="{{ route('orders.show', $order->order_number) }}" class="btn-secondary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">{{ $orders->links() }}</div>
        @else
            <div class="mt-8 rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-12 text-center">
                <div class="text-5xl">📦</div>
                <h2 class="mt-5 text-2xl font-bold text-slate-900">Belum ada pesanan</h2>
                <p class="mt-2 text-slate-500">Pesanan yang Anda buat akan muncul di halaman ini.</p>
            </div>
        @endif
    </section>
@endsection
