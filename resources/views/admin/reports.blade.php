@extends('layouts.admin')

@section('title', 'Laporan')
@section('page-title', 'Laporan')

@section('content')
    <div class="grid gap-6 xl:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900">Penjualan Harian</h2>
            <div class="mt-6 space-y-3">
                @foreach($sales as $sale)
                    <div class="flex items-center justify-between rounded-xl border border-slate-200 p-3">
                        <span class="text-sm text-slate-600">{{ $sale->date }}</span>
                        <div class="text-right">
                            <div class="font-bold text-slate-900">Rp {{ number_format($sale->total_sales, 0, ',', '.') }}</div>
                            <div class="text-xs text-slate-500">{{ $sale->orders_count }} order</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900">Produk Terlaris</h2>
            <div class="mt-6 space-y-3">
                @foreach($topProducts as $product)
                    <div class="flex items-center justify-between rounded-xl border border-slate-200 p-3">
                        <div>
                            <div class="font-semibold text-slate-900">{{ $product->name }}</div>
                            <div class="text-xs text-slate-500">Terjual: {{ $product->sold_quantity ?? 0 }}</div>
                        </div>
                        <div class="font-bold text-slate-900">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
