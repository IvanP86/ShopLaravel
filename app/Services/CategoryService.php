<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

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

    public static function getCategoryChildren(Category $category): Collection
    {
        $collection = Category::hydrate([]);
        $categoryChildren = $category->children;
        foreach ($categoryChildren as $categoryChild) {
            $collection = $collection->merge(self::getCategoryChildren($categoryChild));
        }
        $collection->push($category);

        return $collection;
    }

    public static function getCategoryParents(Category $category): Collection
    {
        $collection = Category::hydrate([]);
        if ($category->parent_id){
            $parentCategory = $category->parent;
            $collection = $collection->push($parentCategory);
            $collection = $collection->merge(self::getCategoryParents($parentCategory));
        }

        return $collection;
    }
}
