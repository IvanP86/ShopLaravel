<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Image\ImageResouce;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'qty' => $this->qty,
            'category_id' => $this->category_id,
            'product_group_id' => $this->product_group_id,
            'images' => ImageResouce::collection($this->images)->resolve()
        ];
    }
}
