<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket() {
        $order_id = session('orderId');
        if (!is_null($order_id)) {
            $order = Order::findOrFail($order_id);
        }
        return view('basket', compact('order'));
    }


    public function order() {
        $order_id = session('orderId');
        if (is_null($order_id)) {
            return redirect()->route('index');
        }

        $order = Order::find($order_id);
        return view('order', compact('order'));
    }


    public function basketConfirm(Request $request)
    {
        $order_id = session('orderId');
        if (is_null($order_id)) {
            return redirect()->route('index');
        }
        $order = Order::find($order_id);
        $success = $order->saveOrder($order, $request->phone, $request->name);

        if ($success) {
            session()->flash('success', 'Ваш заказ принят в обработку!');
        } else {
            session()->flash('warning', 'Произошла ошибка!');
        }
        return redirect()->route('index');
    }


    public function basketAdd($product_id)
    {
        $order_id = session('orderId');

        if (is_null($order_id)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($order_id);
        }

        if ($order->products->contains($product_id)) {
            $pivotRow = $order->products()->where('product_id', $product_id)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($product_id);
        }

        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }

        $product = Product::find($product_id);

        session()->flash('success', 'Добавлен товар ' . $product->name);

        return redirect()->route('basket');
    }


    public function basketRemove($product_id)
    {
        $order_id = session('orderId');
        if (is_null($order_id)) {
            return redirect()->route('basket');
        }
        $order = Order::find($order_id);

        if ($order->products->contains($product_id)) {
            $pivotRow = $order->products()->where('product_id', $product_id)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($product_id);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        $product = Product::find($product_id);

        session()->flash('warning', 'Удален товар ' . $product->name);
        return redirect()->route('basket');
    }
}
