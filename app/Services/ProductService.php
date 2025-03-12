<?php

namespace App\Services;

use App\Models\Product;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public static function store(array $data): Product
    {
        try {
            DB::beginTransaction();
            $product = Product::create($data['product']);
            ProductService::attachBatchParams($product, $data);
            ImageService::storeImages($product, $data);
            DB::commit();
        } catch (Exception $exception) {
            abort(500, 'Admin product store failed');
            DB::rollBack();
        }
        return $product;
    }

    public static function update(Product $product, array $data): Product
    {
        try {
            DB::beginTransaction();
            $product->update($data['product']);
            ProductService::syncBatchParams($product, $data);
            ImageService::storeImages($product, $data);
            DB::commit();
        } catch (Exception $exception) {
            abort(500, 'Admin product update failed');
            DB::rollBack();
        }
        return $product->fresh();
    }

    public static function attachBatchParams(Product $product, array $data): void
    {
        foreach ($data['params'] as $param) {
            $product->params()->attach($param['id'], [
                'value' => $param['value']
            ]);
        }
    }
    public static function syncBatchParams(Product $product, array $data): void
    {
        $product->params()->detach();
        ProductService::attachBatchParams($product, $data);
    }
    public static function getIdsChildrenWithParentCategory(Collection $categories, array $data): Collection
    {
        $products = Product::categoryWithChildren($categories)->whereNotNull('parent_id');
        // $products = Product::categoryWithChildren($categories)->whereNull('parent_id');
        if (isset($data['filters']['integer']['from'])) {
            $products->whereHas('paramProducts', function ($q) use ($data) {
                foreach ($data['filters']['integer']['from'] as $key => $value) {
                    $q->where('param_id', $key)->where('value', '>=', $value);
                }
            });
        }
        if (isset($data['filters']['integer']['to'])) {
            $products->whereHas('paramProducts', function ($q) use ($data) {
                foreach ($data['filters']['integer']['to'] as $key => $value) {
                    $q->where('param_id', $key)->where('value', '=<', $value);
                }
            });
        }
        if (isset($data['filters']['select'])) {
            $products->whereHas('paramProducts', function ($q) use ($data) {
                foreach ($data['filters']['select'] as $key => $value) {
                    $q->where('param_id', $key)->where('value', $value);
                }
            });
        }
        if (isset($data['filters']['checkbox'])) {
            $products->whereHas('paramProducts', function ($q) use ($data) {
                foreach ($data['filters']['checkbox'] as $key => $value) {
                    $q->where('param_id', $key)->whereIn('value', $value);
                }
            });
        }
        return $products->distinct('parent_id')->get();
    }
}
