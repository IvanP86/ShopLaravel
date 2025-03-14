<?php

namespace App\Services;

use App\Models\Product;

class ParamProductService
{
    public static function replicateBatch(Product $product, Product $cloneProduct)
    {
        foreach ($product->paramProducts as $paramProduct) {
            $cloneParamProduct = $paramProduct->replicate();
            $cloneParamProduct->product_id = $cloneProduct->id;
            $cloneParamProduct->push();
        }
    }
}
