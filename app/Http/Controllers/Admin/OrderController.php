<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('auth.orders.index', compact('orders'));
    }
}
