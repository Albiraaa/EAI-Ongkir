@extends('layouts.admin')

@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')

@section('content')
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">
            <div class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">{{ $order->order_number }}</div>
            <div class="mt-3 text-2xl font-black text-slate-900">{{ $order->user?->name ?? 'Guest' }}</div>
            <div class="mt-6 space-y-4">
                @foreach($order->items as $item)
                    <div class="flex items-center justify-between rounded-xl border border-slate-200 p-4">
                        <div>
                            <div class="font-semibold text-slate-900">{{ $item->product_name }}</div>
                            <div class="text-sm text-slate-500">Qty: {{ $item->quantity }}</div>
                        </div>
                        <div class="font-bold text-slate-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900">Status</h2>
            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="mt-4 space-y-4">
                @csrf
                @method('PATCH')
                <select name="status" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <button type="submit" class="btn-primary w-full justify-center">Update Status</button>
            </form>
        </div>
    </div>
@endsection
