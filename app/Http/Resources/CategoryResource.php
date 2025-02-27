<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SubCategoryResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image ? asset($this->image) : null,
            'button_image' => $this ->button_image ? asset($this->button_image) : null,
            'button_image_alt' =>$this->button_image_alt,
            'status' => (bool)$this->status,
            'subCategories' => SubCategoryResource::collection($this->subCategories),
        ];
    }
}