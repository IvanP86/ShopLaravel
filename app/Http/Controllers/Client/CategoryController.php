<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function productIndex(Category $category)
    {
        $categories = CategoryService::getCategoryChildren($category);
        $breadCrumbs = CategoryResource::collection(array_reverse(CategoryService::getCategoryParents($category)))->resolve();
        $products = ProductResource::collection(ProductService::getIdsChildrenWithParentCategory($categories))->resolve();
        $category = CategoryResource::make($category)->resolve();
        return inertia('Client/Category/ProductIndex', compact('products', 'breadCrumbs', 'category'));
    }
}
