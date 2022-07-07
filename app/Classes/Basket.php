<?php

namespace App\Classes;

use App\Mail\OrderCreated;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Basket
{
    protected $order;

    public function __construct()
    {

        $order_id = session('orderId');

        if (is_null($order_id)) {
            $data = [];
            if (Auth::check()) {
                $data['user_id'] = Auth::id();
            }

            $this->order = Order::create($data);
            session(['orderId' => $this->order->id]);
        } else {
            $this->order = Order::findOrFail($order_id);
        }
    }

    protected function getPivotRow($product) {
        return $this->order->products()->where('product_id', $product->id)->first()->pivot;
    }

    public function countAvailable($update_count = false) {
        foreach ($this->order->products as $orderProduct) {
            if ($orderProduct->count < $this->getPivotRow($orderProduct)->count) {
                return False;
            }
            if ($update_count) {
                $orderProduct->count -= $this->getPivotRow($orderProduct)->count;
            }
        }
        if ($update_count) {
            $this->order->products->map->save();
        }

        return True;
    }

    public function getOrder() {
        return $this->order;
    }

    public function addProduct($product)
    {
        if ($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivotRow($product);
            $pivotRow->count++;
            if ($pivotRow->count > $product->count) {
                return False;
            }
            $pivotRow->update();
        } else {
            if ($product->count == 0) {
                return False;
            }
            $this->order->products()->attach($product->id);
        }
        return True;
    }

    public function removeProduct($product)
    {
        if ($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivotRow($product);
            if ($pivotRow->count < 2) {
                $this->order->products()->detach($product->id);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        return True;
    }

    public function saveOrder($name, $phone, $email) {
        if ($this->countAvailable(true)) {
            Mail::to($email)->send(new OrderCreated($name, $this));
            return $this->order->saveOrder($phone, $name);
        }

        return False;
    }
}
