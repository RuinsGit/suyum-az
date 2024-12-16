<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'price' => (float)$this->price,
            'annual_percentage' => (float)$this->annual_percentage,
            'installment_months' => $this->installment_months ? explode(',', $this->installment_months) : [],
            'has_courier' => (bool)$this->has_courier,
            'courier_price' => (float)$this->courier_price,
            'has_installation' => (bool)$this->has_installation,
            'installation_price' => (float)$this->installation_price,
            'main_image' => $this->main_image ? asset($this->main_image) : null,
            'courier_image' => $this->courier_image ? asset($this->courier_image) : null,
            'installation_image' => $this->installation_image ? asset($this->installation_image) : null,
            'payment_image_1' => $this->payment_image_1 ? asset($this->payment_image_1) : null,
            'payment_image_2' => $this->payment_image_2 ? asset($this->payment_image_2) : null,
            'status' => (bool)$this->status,
            'installment_options' => $this->getInstallmentOptions()
        ];
    }
}