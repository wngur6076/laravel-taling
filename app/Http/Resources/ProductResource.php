<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'serial_number' => $this->serial_number,
            'product_by' => new UserResource($this->user),
            'category' => new CategoryResource($this->category),
            'market' => new MarketResource($this->market),
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
            'thumb_img_url' => $this->thumbnailUrl(),
            'price_in_wons' => $this->price_in_wons,
            'sale_price_in_wons' => $this->sale_price_in_wons,
            'colors' => $this->colors(),
            'is_hidden' => $this->is_hidden,
            'is_sold_out' => $this->is_sold_out,
            'hit_count' => $this->hit_count,
            'review_count' => $this->review_count,
            'review_point' => $this->review_point,
            'product_at' => $this->product_at,
        ];
    }
}
