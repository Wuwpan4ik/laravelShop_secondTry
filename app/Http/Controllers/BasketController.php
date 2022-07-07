<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket() {
        $order = (new Basket())->getOrder();
        return view('basket', compact('order'));
    }


    public function order() {
        $basket = new Basket();
        $order = $basket->getOrder();

        if ($basket->countAvailable()) {
            return view('order', compact('order'));
        }

        session()->flash('warning', 'Товар не доступен в полном объемем!');
        return redirect()->route('basket');
    }


    public function basketConfirm(Request $request)
    {
        $success = (new Basket())->saveOrder($request->phone, $request->name, $request->email);

        if ($success) {
            session()->flash('success', 'Ваш заказ принят в обработку!');
        } else {
            session()->flash('warning', 'Произошла ошибка!');
        }

        return redirect()->route('index');
    }


    public function basketAdd(Product $product)
    {
        $result = (new Basket())->addProduct($product);
        if ($result) {
            session()->flash('success', 'Добавлен товар ' . $product->name);
        } else {
            session()->flash('warning', 'Товара ' . $product->name . ' нет в наличие');
        }

        return redirect()->route('basket');
    }


    public function basketRemove(Product $product)
    {
        $result = (new Basket())->removeProduct($product);

        if ($result) {
            session()->flash('warning', 'Удален товар ' . $product->name);
        }
        return redirect()->route('basket');
    }
}
