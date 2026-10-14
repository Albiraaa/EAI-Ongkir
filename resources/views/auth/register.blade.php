@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
    <section class="section-shell py-16">
        <div class="mx-auto grid max-w-6xl overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-xl shadow-slate-200/60 lg:grid-cols-[0.9fr_1.1fr]">
            <div class="relative hidden bg-slate-900 p-10 text-white lg:flex lg:flex-col lg:justify-between">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(45,212,191,0.25),transparent_38%),radial-gradient(circle_at_bottom_right,_rgba(59,130,246,0.20),transparent_30%)]"></div>
                <div class="relative z-10">
                    <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-teal-200">
                        Join today
                    </div>
                    <h1 class="text-4xl font-black leading-tight">Buat akun dan nikmati belanja lebih praktis.</h1>
                    <p class="mt-4 max-w-md text-sm text-slate-200">
                        Daftar sekarang untuk menikmati produk terbaik, promo spesial, dan checkout yang dipersonalisasi sesuai kebutuhan Anda.
                    </p>
                </div>

                <div class="relative z-10 mt-10 space-y-4 text-sm text-slate-200">
                    <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 p-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-teal-500/20 text-teal-300">✓</span>
                        Akses produk unggulan dan update terbaru
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 p-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-teal-500/20 text-teal-300">✓</span>
                        Simpan favorit dan pantau pesanan
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 p-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-teal-500/20 text-teal-300">✓</span>
                        Pengalaman checkout yang lebih mudah
                    </div>
                </div>
            </div>

            <div class="p-6 sm:p-8 lg:p-10">
                <div class="mb-8 flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-[0.18em] text-teal-600">Bergabung</p>
                        <h2 class="mt-2 text-3xl font-black text-slate-900">Buat akun baru</h2>
                    </div>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-3 py-1.5 text-sm font-medium text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">
                        <span>←</span>
                        Beranda
                    </a>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Nama lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm transition focus:border-teal-500 focus:bg-white focus:outline-none @error('name') border-red-300 bg-red-50 @enderror" placeholder="Masukkan nama lengkap">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm transition focus:border-teal-500 focus:bg-white focus:outline-none @error('email') border-red-300 bg-red-50 @enderror" placeholder="you@example.com">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm transition focus:border-teal-500 focus:bg-white focus:outline-none @error('password') border-red-300 bg-red-50 @enderror" placeholder="Minimal 8 karakter">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Konfirmasi password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm transition focus:border-teal-500 focus:bg-white focus:outline-none" placeholder="Ulangi password">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center rounded-2xl px-4 py-3 text-base">Daftar</button>
                </form>

                <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-center text-sm text-slate-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="ml-1 font-semibold text-teal-600 hover:text-teal-500">Masuk sekarang</a>
                </div>
            </div>
        </div>
    </section>
@endsection
