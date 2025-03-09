<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $libraries = Library::with('account', 'game')->paginate(10);
        return view('orders.index', compact('libraries'));
    }

    public function show($id)
    {
        $library = Library::with('account', 'game')->findOrFail($id);
        return view('admin.orders.show', compact('library'));
    }
}
