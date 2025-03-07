<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index()
{
    $orders = Order::paginate(10); // Sử dụng paginate() thay vì get()
    return view('orders.index', compact('orders'));
}

    // Xem chi tiết đơn hàng
    public function show($id)
    {
        $order = Order::with('user', 'items.game')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}
