@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <section class="section-shell py-12">
        <h1 class="text-4xl font-black text-slate-900">Checkout</h1>

        <div class="mt-8 grid gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <form method="POST" action="{{ route('checkout.store') }}" class="space-y-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    @csrf
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Detail Pengiriman</h2>
                        <div class="mt-4 grid gap-4 md:grid-cols-2">
                            <input name="shipping_name" type="text" value="{{ auth()->user()->name ?? '' }}" placeholder="Nama penerima" class="rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                            <input name="shipping_phone" type="text" placeholder="Nomor handphone" class="rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none">
                            <input name="shipping_city_id" type="text" placeholder="City ID tujuan (contoh: 152)" class="rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none md:col-span-2">
                            <input name="shipping_city_name" type="text" placeholder="Nama kota tujuan" class="rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none md:col-span-2">
                            <textarea name="shipping_address" rows="4" placeholder="Alamat lengkap pengiriman" class="rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none md:col-span-2"></textarea>
                            <input name="notes" type="text" placeholder="Catatan (opsional)" class="rounded-xl border border-slate-200 px-4 py-3 focus:border-teal-500 focus:outline-none md:col-span-2">
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Pilih Pengiriman</h2>
                        <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="mb-4 flex items-center gap-3">
                                <select name="shipping_courier" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-teal-500 focus:outline-none">
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                                <input type="hidden" name="weight" value="1000">
                                <button type="button" id="shipping-check-button" class="btn-secondary">Cek Ongkir</button>
                            </div>
                            <div id="shipping-options" class="space-y-3"></div>
                            <input type="hidden" name="shipping_cost" id="shipping_cost" value="0">
                            <input type="hidden" name="shipping_service" id="shipping_service" value="">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center">Konfirmasi Pesanan</button>
                </form>
            </div>

            <aside class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900">Pesanan Anda</h2>
                <div class="mt-5 space-y-4">
                    @foreach($items as $item)
                        @php $product = $item['product']; @endphp
                        <div class="flex items-center justify-between gap-3 border-b border-slate-200 pb-3">
                            <div>
                                <div class="font-semibold text-slate-900">{{ $product->name }}</div>
                                <div class="text-sm text-slate-500">{{ $item['quantity'] }} item</div>
                            </div>
                            <div class="font-semibold text-slate-900">Rp {{ number_format($item['line_total'], 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5 space-y-2 text-sm text-slate-600">
                    <div class="flex justify-between"><span>Subtotal</span><span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                    <div class="flex justify-between"><span>Ongkir</span><span id="shipping_cost_display">Rp 0</span></div>
                    <div class="flex justify-between border-t border-slate-200 pt-2 text-base font-bold text-slate-900"><span>Total</span><span id="total_display">Rp {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                </div>
            </aside>
        </div>
    </section>

    <script>
        document.getElementById('shipping-check-button')?.addEventListener('click', async () => {
            const cityId = document.querySelector('input[name="shipping_city_id"]').value;
            const courier = document.querySelector('select[name="shipping_courier"]').value;
            const list = document.getElementById('shipping-options');

            if (!cityId) {
                alert('Masukkan city_id tujuan terlebih dahulu.');
                return;
            }

            const response = await fetch('/api/shipping/check', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ destination_city_id: cityId, courier, weight: 1000 })
            });

            const payload = await response.json();
            list.innerHTML = '';

            payload.data?.forEach((option) => {
                const label = document.createElement('label');
                const cost = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(option.cost);

                label.className = 'flex cursor-pointer items-center justify-between rounded-xl border border-slate-200 bg-white p-3';
                label.innerHTML = `
                    <div>
                        <div class="font-semibold text-slate-900">${option.service}</div>
                        <div class="text-xs text-slate-500">${option.description || 'Layanan pengiriman'} · ${option.etd}</div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-teal-600">${cost}</div>
                        <input type="radio" name="shipping_option" value="${option.service}" class="mt-2" />
                    </div>
                `;

                label.querySelector('input').addEventListener('change', () => {
                    document.getElementById('shipping_cost').value = option.cost;
                    document.getElementById('shipping_service').value = option.service;
                    document.getElementById('shipping_cost_display').textContent = cost;

                    const subtotal = {{ $subtotal }};
                    const total = subtotal + option.cost;
                    document.getElementById('total_display').textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(total);
                });

                list.appendChild(label);
            });
        });
    </script>
@endsection
