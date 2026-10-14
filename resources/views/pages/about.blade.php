@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
    <section class="section-shell py-12">
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-teal-600">Tentang</p>
            <h1 class="mt-4 text-4xl font-black text-slate-900">Marketplace Ongkir</h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-slate-600">Marketplace Ongkir adalah platform e-commerce yang memudahkan pelanggan mencari produk dan mendapatkan estimasi biaya pengiriman secara otomatis melalui RajaOngkir API. Proyek ini dirancang dengan arsitektur Laravel yang bersih, rapi, dan siap untuk pengembangan lebih lanjut.</p>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <div class="rounded-2xl bg-slate-50 p-5">
                    <div class="text-3xl font-black text-teal-600">100%</div>
                    <div class="mt-2 text-sm text-slate-600">Integrasi API shipment</div>
                </div>
                <div class="rounded-2xl bg-slate-50 p-5">
                    <div class="text-3xl font-black text-teal-600">2</div>
                    <div class="mt-2 text-sm text-slate-600">Role pengguna
                    </div>
                </div>
                <div class="rounded-2xl bg-slate-50 p-5">
                    <div class="text-3xl font-black text-teal-600">12+</div>
                    <div class="mt-2 text-sm text-slate-600">Produk sample</div>
                </div>
            </div>
        </div>
    </section>
@endsection
