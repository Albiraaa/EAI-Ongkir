@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <section class="section-shell py-12">
        <h1 class="text-4xl font-black text-slate-900">Keranjang Belanja</h1>

        @if(count($items) > 0)
            <div class="mt-8 grid gap-8 lg:grid-cols-3">
                <div class="space-y-4 lg:col-span-2">
                    @foreach($items as $item)
                        @php $product = $item['product']; @endphp
                        <div class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:flex-row">
                            <img src="{{ $product->image ? (str_contains($product->image, 'http') ? $product->image : asset('storage/' . $product->image)) : 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $product->name }}" class="h-28 w-full rounded-2xl object-cover sm:w-28">
                            <div class="flex flex-1 flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <div class="text-xl font-bold text-slate-900">{{ $product->name }}</div>
                                    <div class="mt-1 text-sm text-slate-500">Rp {{ number_format($product->price, 0, ',', '.') }} / item</div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <form action="{{ route('cart.update', $product->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-20 rounded-xl border border-slate-200 px-3 py-2 text-center">
                                        <button type="submit" class="btn-secondary">Update</button>
                                    </form>
                                    <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-semibold text-red-600">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <aside class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900">Ringkasan</h2>
                    <div class="mt-5 space-y-3 text-sm text-slate-600">
                        <div class="flex justify-between"><span>Subtotal</span><span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                        <div class="flex justify-between"><span>Pengiriman</span><span>Hitung saat checkout</span></div>
                    </div>
                    <div class="mt-5 border-t border-slate-200 pt-4">
                        <div class="flex justify-between text-base font-bold text-slate-900"><span>Total</span><span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn-primary mt-6 w-full justify-center">Lanjut ke Checkout</a>
                </aside>
            </div>
        @else
            <div class="mt-8 rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-12 text-center">
                <div class="text-5xl">🛒</div>
                <h2 class="mt-5 text-2xl font-bold text-slate-900">Keranjang Anda masih kosong</h2>
                <p class="mt-2 text-slate-500">Belum ada produk yang ditambahkan. Jelajahi katalog kami untuk memulai belanja.</p>
                <a href="{{ route('products.index') }}" class="btn-primary mt-6">Mulai Belanja</a>
            </div>
        @endif
    </section>
@endsection
