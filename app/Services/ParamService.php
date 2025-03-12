<?php

namespace App\Services;

use App\Models\Param;
use Illuminate\Support\Collection;

class ParamService
{
    public static function store(array $data): Param
    {
        return Param::create($data);
    }

    public static function update(Param $param, array $data): Param
    {
        $param->update($data);
        return $param->fresh();
    }

    public static function getParamsByCategories(Collection $collection): Collection
    {
        $array = [];
        foreach ($collection->pluck('paramProducts') as $paramProduct) {
            $array = array_merge($array, $paramProduct->toArray());
        }
        $array = collect($array);
        $params = Param::whereIn('id', $array->pluck('param_id'))->get();
        $collect = $array->groupBy('param_id');
        foreach ($params as $param) {
            $param->param_values = $collect[$param->id]->unique('value')->sortBy('value')->pluck('value')->toArray();
        }

        return $params;
    }
}
