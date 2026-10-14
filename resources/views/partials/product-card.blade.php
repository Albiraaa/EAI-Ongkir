<article class="product-card">
    <a href="{{ route('products.show', $product->slug) }}" class="block">
        <img src="{{ $product->image ? (str_contains($product->image, 'http') ? $product->image : asset('storage/' . $product->image)) : 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $product->name }}" class="h-64 w-full object-cover">
    </a>
    <div class="p-5">
        <div class="mb-2 flex items-center justify-between gap-2">
            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.18em] text-slate-500">{{ $product->category->name ?? 'Umum' }}</span>
            @if($product->featured)
                <span class="badge bg-amber-100 text-amber-700">Best Seller</span>
            @endif
        </div>
        <a href="{{ route('products.show', $product->slug) }}" class="block text-lg font-bold text-slate-900 transition hover:text-teal-600">{{ $product->name }}</a>
        <p class="mt-2 line-clamp-2 text-sm text-slate-500">{{ Str::limit($product->description, 80) }}</p>
        <div class="mt-4 flex items-end justify-between">
            <div>
                <div class="text-2xl font-black text-slate-900">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                @if($product->compare_price)
                    <div class="text-sm text-slate-400 line-through">Rp {{ number_format($product->compare_price, 0, ',', '.') }}</div>
                @endif
            </div>
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn-primary">Add to cart</button>
            </form>
        </div>
    </div>
</article>
