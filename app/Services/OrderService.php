<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public static function store(): Order
    {
        $order =  Auth::user()->orders()->create();
        Auth::user()->carts()->update(['order_id' => $order->id]);
        return $order;
    }
}
