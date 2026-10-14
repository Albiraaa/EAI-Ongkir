@extends('layouts.app')

@section('title', 'Marketplace Ongkir')

@section('content')
    <section class="section-shell py-12 lg:py-16">
        <div class="grid items-center gap-10 lg:grid-cols-2">
            <div>
                <span class="inline-flex rounded-full bg-teal-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-teal-700">Marketplace Modern</span>
                <h1 class="mt-5 text-4xl font-black tracking-tight text-slate-900 sm:text-5xl">Belanja mudah, ongkir otomatis, transaksi lebih cepat.</h1>
                <p class="mt-5 max-w-xl text-lg text-slate-600">Marketplace Ongkir membantu pelanggan mengecek biaya kirim secara otomatis menggunakan RajaOngkir API tanpa metode perhitungan manual.</p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}" class="btn-primary">Lihat Produk</a>
                    <a href="{{ route('about') }}" class="btn-secondary">Pelajari Lebih Lanjut</a>
                </div>
                <div class="mt-8 grid max-w-md grid-cols-3 gap-4">
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <div class="text-2xl font-black text-teal-600">12+</div>
                        <div class="text-xs text-slate-500">Produk</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <div class="text-2xl font-black text-teal-600">5</div>
                        <div class="text-xs text-slate-500">Kategori</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <div class="text-2xl font-black text-teal-600">24/7</div>
                        <div class="text-xs text-slate-500">Support</div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -left-8 top-10 h-32 w-32 rounded-full bg-teal-200/70 blur-3xl"></div>
                <div class="absolute -right-6 bottom-8 h-32 w-32 rounded-full bg-indigo-200/70 blur-3xl"></div>
                <div class="relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-4 shadow-xl">
                    <img src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&w=1200&q=80" alt="Marketplace hero" class="h-[440px] w-full rounded-[1.5rem] object-cover">
                    <div class="absolute inset-x-8 bottom-8 rounded-2xl border border-white/20 bg-slate-900/75 p-4 text-white backdrop-blur">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs uppercase tracking-[0.2em] text-slate-300">Delivery Status</div>
                                <div class="mt-1 text-xl font-bold">RajaOngkir Integrated</div>
                            </div>
                            <span class="rounded-full bg-emerald-500 px-2 py-1 text-xs font-semibold text-white">Live</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-shell py-8">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900">Kategori Unggulan</h2>
            <a href="{{ route('products.index') }}" class="text-sm font-semibold text-teal-600">Lihat semua</a>
        </div>
        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-5">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="{{ $category->image ? (str_contains($category->image, 'http') ? $category->image : asset('storage/' . $category->image)) : 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $category->name }}" class="h-36 w-full object-cover">
                    <div class="p-4">
                        <div class="text-lg font-bold text-slate-900">{{ $category->name }}</div>
                        <p class="mt-1 text-sm text-slate-500">{{ $category->products_count }} produk</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="section-shell py-12">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900">Produk Pilihan</h2>
            <a href="{{ route('products.index') }}" class="text-sm font-semibold text-teal-600">Semua produk</a>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
            @foreach($featuredProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <section class="section-shell py-12">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900">Terbaru</h2>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
            @foreach($latestProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>
@endsection
