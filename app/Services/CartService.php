<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public static function store(array $data): Cart
    {
        return Auth::user()->carts()->create($data);
    }

    public static function update(Cart $cart, array $data): Cart
    {
        $cart->update($data);
        return $cart->fresh();
    }
}
