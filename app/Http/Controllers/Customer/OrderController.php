<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->where('user_id', Auth::id())->latest()->paginate(10);

        return view('pages.orders.index', compact('orders'));
    }

    public function show(string $orderNumber)
    {
        $order = Order::with('items.product')->where('order_number', $orderNumber)->firstOrFail();

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pages.orders.show', compact('order'));
    }
}
