<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public static function store(array $data): Category
    {
        return Category::create($data);
    }

    public static function update(Category $category, array $data): Category
    {
        $category->update($data);
        return $category->fresh();
    }

    public static function getCategoryChildren(Category $category): array
    {
        $array = [];
        $categoryChildren = Category::where('parent_id', $category->id)->get();
        foreach ($categoryChildren as $categoryChild) {
            $array = array_merge($array, self::getCategoryChildren($categoryChild));
        }
        $array[] = $category;

        return $array;
    }

    public static function getCategoryParents(Category $category): array
    {
        $array = [];
        if ($category->parent_id){
            $parentCategory = Category::findOrFail($category->parent_id);
            $array[] = $parentCategory;
            $array = array_merge($array, self::getCategoryParents($parentCategory));
        }

        return $array;
    }
}
