@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
    <section class="section-shell py-12">
        <div class="grid gap-8 lg:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-teal-600">Hubungi Kami</p>
                <h1 class="mt-4 text-4xl font-black text-slate-900">Ada pertanyaan?</h1>
                <div class="mt-8 space-y-4 text-slate-600">
                    <div>📍 Jl. Merdeka No. 17, Bandung</div>
                    <div>📞 0800-123-456</div>
                    <div>✉️ hello@marketplaceongkir.test</div>
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <form class="space-y-4">
                    <input type="text" placeholder="Nama" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                    <input type="email" placeholder="Email" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                    <textarea rows="5" placeholder="Pesan" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none"></textarea>
                    <button type="button" class="btn-primary">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </section>
@endsection
