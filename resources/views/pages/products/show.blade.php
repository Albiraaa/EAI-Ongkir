@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <section class="section-shell py-12">
        <div class="grid gap-10 lg:grid-cols-2">
            <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-3 shadow-sm">
                <img src="{{ $product->image ? (str_contains($product->image, 'http') ? $product->image : asset('storage/' . $product->image)) : 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $product->name }}" class="h-[520px] w-full rounded-[1.5rem] object-cover">
            </div>

            <div>
                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">{{ $product->category->name ?? 'Produk' }}</span>
                <h1 class="mt-4 text-4xl font-black text-slate-900">{{ $product->name }}</h1>
                <div class="mt-4 flex items-center gap-3">
                    <div class="text-3xl font-black text-slate-900">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    @if($product->compare_price)
                        <div class="text-lg text-slate-400 line-through">Rp {{ number_format($product->compare_price, 0, ',', '.') }}</div>
                    @endif
                </div>

                <p class="mt-6 text-base leading-7 text-slate-600">{{ $product->description }}</p>

                <div class="mt-8 flex items-center gap-4">
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-3">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1" class="w-20 rounded-xl border border-slate-200 px-3 py-2 text-center focus:border-teal-500 focus:outline-none">
                        <button type="submit" class="btn-primary">Tambah ke Keranjang</button>
                    </form>
                </div>

                <div class="mt-8 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <div class="mb-3 text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Cek Ongkir</div>
                    <form id="shipping-form" class="space-y-3">
                        <div class="grid gap-3 md:grid-cols-3">
                            <input type="text" name="destination_city_id" placeholder="Masukkan city_id tujuan" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-teal-500 focus:outline-none">
                            <select name="shipping_courier" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-teal-500 focus:outline-none">
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                                <option value="tiki">TIKI</option>
                            </select>
                            <input type="hidden" name="weight" value="1000">
                            <button type="submit" class="btn-primary">Cek Ongkir</button>
                        </div>
                    </form>
                    <div id="shipping-options" class="mt-4 space-y-3"></div>
                </div>
            </div>
        </div>

        <div class="mt-16">
            <h2 class="text-3xl font-bold text-slate-900">Produk Terkait</h2>
            <div class="mt-6 grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                @foreach($relatedProducts as $item)
                    @include('partials.product-card', ['product' => $item])
                @endforeach
            </div>
        </div>
    </section>
@endsection
