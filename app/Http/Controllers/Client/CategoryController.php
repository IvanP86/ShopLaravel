<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Category\ProductIndexRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Param\ParamWithValuesResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ParamService;
use App\Services\ProductService;

class CategoryController extends Controller
{

    public function index(){

        $categories = CategoryResource::collection(Category::whereNull('parent_id')->get())->resolve();
        return inertia('Client/Category/Index', compact('categories'));
    }
    public function productIndex(Category $category, ProductIndexRequest $request)
    {
        $data = $request->validated();
        $categories = CategoryService::getCategoryChildren($category);
        $params = ParamService::getParamsByCategories($categories);
        $params = ParamWithValuesResource::collection($params)->resolve();
        $products = ProductResource::collection(ProductService::getIdsChildrenWithParentCategory($categories, $data))->resolve();
        if ($request->wantsJson()) {
            return $products;
        }
        $breadCrumbs = CategoryResource::collection(CategoryService::getCategoryParents($category)->reverse())->resolve();
        $categoryChildren = CategoryResource::collection($category->children)->resolve();
        $category = CategoryResource::make($category)->resolve();
        return inertia('Client/Category/ProductIndex', compact('products', 'categoryChildren', 'breadCrumbs', 'category', 'params'));
    }
}
