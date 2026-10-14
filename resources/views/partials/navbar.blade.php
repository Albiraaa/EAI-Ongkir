<nav class="bg-white shadow-sm ring-1 ring-slate-200/80">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-600 text-lg font-bold text-white">MO</div>
            <div>
                <div class="text-lg font-black tracking-tight text-slate-900">Marketplace Ongkir</div>
                <div class="text-[11px] uppercase tracking-[0.2em] text-slate-500">E-commerce</div>
            </div>
        </a>

        <div class="hidden items-center gap-6 md:flex">
            <a href="{{ route('home') }}" class="text-sm font-medium text-slate-700 transition hover:text-teal-600">Home</a>
            <a href="{{ route('products.index') }}" class="text-sm font-medium text-slate-700 transition hover:text-teal-600">Produk</a>
            <a href="{{ route('about') }}" class="text-sm font-medium text-slate-700 transition hover:text-teal-600">Tentang</a>
            <a href="{{ route('contact') }}" class="text-sm font-medium text-slate-700 transition hover:text-teal-600">Kontak</a>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('cart.index') }}" class="relative inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-medium text-slate-700">
                🛒
                <span>Cart</span>
                <span class="inline-flex h-6 min-w-6 items-center justify-center rounded-full bg-teal-600 px-1.5 text-xs font-bold text-white">
                    {{ count(session('cart', [])) }}
                </span>
            </a>
//Albira
            @auth
                <a href="{{ route('orders.index') }}" class="hidden rounded-full border border-slate-200 px-3 py-2 text-sm font-medium text-slate-700 sm:inline-flex">Pesanan</a>
                <a href="{{ route('profile.index') }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">{{ auth()->user()->name }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-full border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="rounded-full border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Masuk</a>
                <a href="{{ route('register') }}" class="rounded-full bg-teal-600 px-4 py-2 text-sm font-medium text-white">Daftar</a>
            @endauth
        </div>
    </div>
</nav>
