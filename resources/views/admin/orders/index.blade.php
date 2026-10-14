@extends('layouts.admin')

@section('title', 'Pesanan')
@section('page-title', 'Pesanan')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="flex flex-col gap-3 rounded-xl border border-slate-200 p-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <div class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">{{ $order->order_number }}</div>
                        <div class="mt-1 text-lg font-bold text-slate-900">{{ $order->user?->name ?? 'Guest' }}</div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="badge bg-slate-100 text-slate-700">{{ ucfirst($order->status) }}</span>
                        <div class="font-black text-slate-900">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn-secondary">Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
