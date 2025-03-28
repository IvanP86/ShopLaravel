<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductWithGropedParamResource;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductResource::collection(Product::whereNull('parent_id')->get())->resolve();
        return inertia('Client/Product/Index', compact('products'));
    }

    public function show(Product $product)
    {
        $breadCrumbs = CategoryService::getCategoryParents($product->category);
        $breadCrumbs = CategoryResource::collection($breadCrumbs->reverse()->push($product->category))->resolve();
        $product = ProductWithGropedParamResource::make($product)->resolve();
        return inertia('Client/Product/Show', compact('product', 'breadCrumbs'));
    }
}
