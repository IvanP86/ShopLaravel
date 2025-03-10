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

    public static function getIdsChildrenWithParentCategory(Collection $categories): Collection
    {
        return Product::categoryWithChildren($categories)->whereNull('parent_id')->get();
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
}
