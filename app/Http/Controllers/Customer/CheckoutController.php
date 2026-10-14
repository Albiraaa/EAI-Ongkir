<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        $items = [];
        $subtotal = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if (! $product) {
                continue;
            }

            $lineTotal = $product->price * $item['quantity'];
            $subtotal += $lineTotal;
            $items[] = ['product' => $product, 'quantity' => $item['quantity'], 'line_total' => $lineTotal];
        }

        return view('pages.checkout', compact('items', 'subtotal'));
    }

    public function store(CheckoutRequest $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = 0;
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal += $product->price * $item['quantity'];
            }
        }

        $shippingCost = (float) $request->input('shipping_cost', 0);
        $total = $subtotal + $shippingCost;

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'MO-'.strtoupper(Str::random(8)),
            'status' => 'pending',
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            'shipping_city_id' => $request->shipping_city_id,
            'shipping_city_name' => $request->shipping_city_name,
            'shipping_courier' => $request->shipping_courier,
            'shipping_service' => $request->shipping_service,
            'shipping_address' => $request->shipping_address,
            'notes' => $request->notes,
        ]);

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if (! $product) {
                continue;
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order->order_number)
            ->with('success', 'Pesanan berhasil dibuat.');
    }
}
