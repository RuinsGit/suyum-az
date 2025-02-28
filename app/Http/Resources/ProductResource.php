<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubCategoryResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'name' => $this->name,
            'cartridge' => $this->cartridge,
            'pressurerange' => $this->pressurerange,
            'temperaturerang' => $this->temperaturerang,
            'dimensions' => $this->dimensions,
            'warranty' => $this->warranty,
            'country' => $this->country,
            'description' => $this->description,
            'price' => number_format((float)$this->price, 2, '.', ''),
            'annual_percentage' => (float)$this->annual_percentage,
            'installment' => [
                'months' => $this->installment_months ? explode(',', $this->installment_months) : [],
                'options' => $this->getInstallmentOptions(),
            ],
            'has_courier' => (bool)$this->has_courier,
            'courier_price' => number_format((float)$this->courier_price, 2, '.', ''),
            'has_installation' => (bool)$this->has_installation,
            'installation_price' => number_format((float)$this->installation_price, 2, '.', ''),
            'main_image' => $this->main_image ? asset($this->main_image) : null,
            'main_image_alt' => $this->image_alt,
            'main_image_meta_title' => $this->main_image_meta_title,
            'main_image_meta_description' => $this->main_image_meta_description,
            'courier_image' => $this->courier_image ? asset($this->courier_image) : null,
            'installation_image' => $this->installation_image ? asset($this->installation_image) : null,
            'payment_image_1' => $this->payment_image_1 ? asset($this->payment_image_1) : null,
            'payment_image_2' => $this->payment_image_2 ? asset($this->payment_image_2) : null,
            'product_video' => $this->product_video ? asset($this->product_video) : null,
            'status' => (bool)$this->status,
            'discount' => number_format((float)$this->discount, 2, '.', ''),
            'category' => new CategoryResource($this->category),
            'subCategory' => new SubCategoryResource($this->subCategory),
            'is_new' => (bool)$this->is_new,
            
        ];
    }
}