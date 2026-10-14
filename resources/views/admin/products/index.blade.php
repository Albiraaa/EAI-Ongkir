@extends('layouts.admin')

@section('title', 'Produk Admin')
@section('page-title', 'Produk')

@section('content')
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-slate-900">Daftar Produk</h2>
        <a href="{{ route('admin.products.create') }}" class="btn-primary">Tambah Produk</a>
    </div>

    <div class="mt-6 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @foreach($products as $product)
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $product->name }}" class="h-48 w-full rounded-2xl object-cover">
                <div class="mt-4">
                    <div class="text-lg font-bold text-slate-900">{{ $product->name }}</div>
                    <div class="mt-1 text-sm text-slate-500">{{ $product->category->name ?? '-' }}</div>
                    <div class="mt-2 text-xl font-black text-slate-900">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                </div>
                <div class="mt-4 flex gap-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="flex-1 rounded-xl border border-amber-200 bg-amber-50 px-4 py-2.5 text-center text-sm font-semibold text-amber-700">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-700">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
