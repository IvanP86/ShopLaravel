<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductWithGropedParamResource;
use App\Models\ParamProduct;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ParamProductService;
use App\Services\ParamService;
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
        // $paramProducts = ParamProduct::whereIn('product_id', $product->siblingProducts->pluck('id'))->with('param')->get();
        // $paramProducts = $paramProducts->groupBy('param_id')->map(function($paramProductItem){
        //     return [
        //         'title' => $paramProductItem->first()->title,
        //         'data' => $paramProductItem->toArray()
        //     ];
        // });
        // $paramProducts = array_values($paramProducts->toArray());
        $paramProducts = ParamProductService::getGroupedByParamArray($product);
        $product = ProductWithGropedParamResource::make($product)->resolve();
        return inertia('Client/Product/Show', compact('product', 'breadCrumbs', 'paramProducts'));
    }
}
