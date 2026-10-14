<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $sales = Order::selectRaw('DATE(created_at) as date, SUM(total) as total_sales, COUNT(*) as orders_count')->groupBy('date')->orderBy('date', 'desc')->limit(7)->get();
        $topProducts = Product::select('products.*', DB::raw('(SELECT SUM(quantity) FROM order_items WHERE product_id = products.id) as sold_quantity'))->orderByDesc('sold_quantity')->limit(5)->get();

        return view('admin.reports', compact('sales', 'topProducts'));
    }
}
