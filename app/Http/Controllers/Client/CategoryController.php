<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Category\ProductIndexRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Mappers\Client\CategoryMapper;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index(){

        $categories = CategoryResource::collection(Category::whereNull('parent_id')->get())->resolve();

        return inertia('Client/Category/Index', compact('categories'));
    }
    public function productIndex(Category $category, ProductIndexRequest $request)
    {
        $data = $request->validated();
        if ($request->wantsJson()) {
            return CategoryMapper::productIndexAsJson($category, $data);
        }

        return inertia('Client/Category/ProductIndex', CategoryMapper::productIndex($category, $data));
    }
}
