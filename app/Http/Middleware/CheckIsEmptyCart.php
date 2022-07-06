<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;

class CheckIsEmptyCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $order_id = session('orderId');

        if (!is_null($order_id)) {
            $order = Order::find($order_id);
            if ($order->products->count() > 0) {
                return $next($request);
            }
        }
        session()->flash('warning', 'Ваша карзина пуста!');
        return redirect()->route('index');
    }
}
