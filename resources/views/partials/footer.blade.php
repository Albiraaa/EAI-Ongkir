<footer class="mt-16 border-t border-slate-200 bg-slate-900 text-slate-200">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid-cols-4 lg:px-8">
        <div>
            <div class="mb-4 text-2xl font-black tracking-tight text-white">Marketplace Ongkir</div>
            <p class="text-sm text-slate-400">Marketplace modern yang memudahkan pelanggan mengecek ongkir otomatis melalui RajaOngkir API.</p>
        </div>
        <div>
            <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Navigasi</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-white">Produk</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-white">Tentang</a></li>
            </ul>
        </div>
        <div>
            <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Layanan</h3>
            <ul class="space-y-2 text-sm">
                <li>Pengiriman Cepat</li>
                <li>Jaminan Aman</li>
                <li>Customer Support</li>
            </ul>
        </div>
        <div>
            <h3 class="mb-4 text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Kontak</h3>
            <ul class="space-y-2 text-sm">
                <li>📍 Bandung, Indonesia</li>
                <li>📞 0800-123-456</li>
                <li>✉️ hello@marketplaceongkir.test</li>
            </ul>
        </div>
    </div>
    <div class="border-t border-slate-800 py-4 text-center text-xs text-slate-400">
        © {{ date('Y') }} Marketplace Ongkir. All rights reserved.
    </div>
</footer>
