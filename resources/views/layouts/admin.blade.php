<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Admin | Marketplace Ongkir')</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    </head>
    <body class="bg-slate-100 font-[Inter] text-slate-800 antialiased">
        <div class="min-h-screen lg:flex">
            <aside class="w-full bg-slate-900 text-slate-200 lg:w-72">
                <div class="flex items-center justify-between border-b border-slate-700 px-6 py-5">
                    <div>
                        <div class="text-xl font-black text-white">Marketplace Ongkir</div>
                        <div class="text-xs uppercase tracking-[0.2em] text-slate-400">Admin panel</div>
                    </div>
                </div>

                <nav class="space-y-2 px-4 py-6">
                    <a href="{{ route('admin.dashboard') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-200 transition hover:bg-slate-800">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-200 transition hover:bg-slate-800">Produk</a>
                    <a href="{{ route('admin.categories.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-200 transition hover:bg-slate-800">Kategori</a>
                    <a href="{{ route('admin.storage.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-200 transition hover:bg-slate-800">Storage</a>
                    <a href="{{ route('admin.orders.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-200 transition hover:bg-slate-800">Pesanan</a>
                    <a href="{{ route('admin.customers.index') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-200 transition hover:bg-slate-800">Pelanggan</a>
                    <a href="{{ route('admin.shipping-settings') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-200 transition hover:bg-slate-800">Shipping Settings</a>
                    <a href="{{ route('admin.reports') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-200 transition hover:bg-slate-800">Laporan</a>
                    <a href="{{ route('home') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-teal-300 transition hover:bg-slate-800">Lihat Storefront</a>
                </nav>
            </aside>

            <div class="flex-1">
                <header class="border-b border-slate-200 bg-white px-6 py-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-slate-900">@yield('page-title', 'Dashboard')</h1>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-700">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="rounded-full border border-slate-200 px-3 py-2 text-sm font-medium text-slate-700">Logout</button>
                            </form>
                        </div>
                    </div>
                </header>

                <main class="p-6">
                    @include('partials.flash-message')
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
