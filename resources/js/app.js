import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

const shippingForm = document.getElementById('shipping-form');

if (shippingForm) {
    shippingForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const formData = new FormData(shippingForm);
        const cityId = formData.get('shipping_city_id');
        const courier = formData.get('shipping_courier') || 'jne';
        const weight = formData.get('weight') || 1000;

        if (!cityId) {
            return;
        }

        const response = await fetch('/api/shipping/check', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ destination_city_id: cityId, courier, weight }),
        });

        const payload = await response.json();
        const list = document.getElementById('shipping-options');

        if (!list) {
            return;
        }

        list.innerHTML = '';

        payload.data?.forEach((option) => {
            const item = document.createElement('label');
            const cost = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(option.cost);

            item.className = 'flex cursor-pointer items-center justify-between rounded-xl border border-slate-200 p-3';
            item.innerHTML = `
                <div>
                    <div class="font-semibold text-slate-900">${option.service}</div>
                    <div class="text-xs text-slate-500">${option.description || 'Layanan pengiriman'} · ${option.etd}</div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-teal-600">${cost}</div>
                    <input type="radio" name="shipping_service" value="${option.service}" class="mt-2" />
                </div>
            `;

            item.querySelector('input').addEventListener('change', () => {
                document.getElementById('shipping_cost').value = option.cost;
                document.getElementById('shipping_service_label').value = `${option.service} (${option.etd})`;
                document.getElementById('shipping_cost_display').textContent = cost;
            });

            list.appendChild(item);
        });
    });
}
