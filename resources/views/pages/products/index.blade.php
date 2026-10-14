@extends('layouts.app')

@section('title', 'Semua Produk')

@section('content')
    <section class="section-shell py-12">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-teal-600">Katalog</p>
                <h1 class="mt-2 text-4xl font-black text-slate-900">Produk Kami</h1>
            </div>
            <form method="GET" class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-teal-500 focus:outline-none md:w-72">
                <button type="submit" class="btn-primary">Cari</button>
            </form>
        </div>

        <div class="mb-8 flex flex-wrap gap-3">
            <a href="{{ route('products.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700">Semua</a>
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700">{{ $category->name }}</a>
            @endforeach
        </div>

        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
            @forelse($products as $product)
                @include('partials.product-card', ['product' => $product])
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-slate-500 md:col-span-2 xl:col-span-4">Belum ada produk pada katalog saat ini.</div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $products->links() }}
        </div>
    </section>
@endsection
