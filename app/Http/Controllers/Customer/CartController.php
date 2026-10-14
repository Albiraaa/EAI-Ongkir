<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $items = [];
        $subtotal = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            if (! $product) {
                continue;
            }

            $lineTotal = $product->price * $item['quantity'];
            $subtotal += $lineTotal;

            $items[] = [
                'product' => $product,
                'quantity' => $item['quantity'],
                'line_total' => $lineTotal,
            ];
        }

        return view('pages.cart', compact('items', 'subtotal'));
    }

    public function add(Request $request, Product $product)
    {
        $quantity = max(1, (int) ($request->input('quantity', 1)));
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', $product->name.' berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        if (! isset($cart[$productId])) {
            return back()->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $cart[$productId]['quantity'] = max(1, (int) $request->input('quantity', 1));
        session()->put('cart', $cart);

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Keranjang berhasil dikosongkan.');
    }
}
