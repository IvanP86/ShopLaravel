<?php

namespace App\Mappers\Client;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Param\ParamWithValuesResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ParamService;
use App\Services\ProductService;

class CategoryMapper
{
    public static function productIndex(Category $category, array $data): array
    {
        $categories = CategoryService::getCategoryChildren($category);
        $params = ParamService::getParamsByCategories($categories);
        $params = ParamWithValuesResource::collection($params)->resolve();
        $products = ProductResource::collection(ProductService::getIdsChildrenWithParentCategory($categories, $data))->resolve();

        $breadCrumbs = CategoryResource::collection(CategoryService::getCategoryParents($category)->reverse())->resolve();
        $categoryChildren = CategoryResource::collection($category->children)->resolve();
        $category = CategoryResource::make($category)->resolve();
        return [
            'products' => $products,
            'params' => $params,
            'breadCrumbs' => $breadCrumbs,
            'categoryChildren' => $categoryChildren,
            'category' => $category
        ];
    }

    public static function productIndexAsJson(Category $category, array $data): array
    {
        $categories = CategoryService::getCategoryChildren($category);
        $products = ProductResource::collection(ProductService::getIdsChildrenWithParentCategory($categories, $data))->resolve();
        return [
            'products' => $products
        ];
    }
}
