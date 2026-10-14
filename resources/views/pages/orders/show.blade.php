@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <section class="section-shell py-12">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-teal-600">Order</p>
                <h1 class="mt-2 text-4xl font-black text-slate-900">{{ $order->order_number }}</h1>
            </div>
            <span class="badge {{ $order->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($order->status === 'paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700') }}">{{ ucfirst($order->status) }}</span>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900">Detail Produk</h2>
                <div class="mt-5 space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center justify-between gap-4 border-b border-slate-200 pb-4">
                            <div>
                                <div class="font-semibold text-slate-900">{{ $item->product_name }}</div>
                                <div class="text-sm text-slate-500">Qty: {{ $item->quantity }}</div>
                            </div>
                            <div class="font-semibold text-slate-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <aside class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900">Ringkasan</h2>
                <div class="mt-5 space-y-3 text-sm text-slate-600">
                    <div class="flex justify-between"><span>Subtotal</span><span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span></div>
                    <div class="flex justify-between"><span>Ongkir</span><span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span></div>
                    <div class="flex justify-between border-t border-slate-200 pt-3 text-base font-bold text-slate-900"><span>Total</span><span>Rp {{ number_format($order->total, 0, ',', '.') }}</span></div>
                </div>
                <div class="mt-6 rounded-xl bg-slate-50 p-4">
                    <div class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Alamat Pengiriman</div>
                    <div class="mt-2 text-sm text-slate-700">{{ $order->shipping_address }}</div>
                    <div class="mt-1 text-sm text-slate-500">{{ $order->shipping_city_name }} · {{ $order->shipping_courier }} {{ $order->shipping_service }}</div>
                </div>
            </aside>
        </div>
    </section>
@endsection
