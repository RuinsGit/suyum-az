<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image ? asset($this->image) : null,
            'image_alt' => $this->image_alt,
            'bottom_image' => $this->bottom_image ? asset($this->bottom_image) : null,
            'bottom_image_alt' => $this->bottom_image_alt,
            'status' => (bool)$this->status,
            
           
        ];
    }
}