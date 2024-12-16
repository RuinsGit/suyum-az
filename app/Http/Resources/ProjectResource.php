<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image ? asset($this->image) : null,
            'name' => $this->name,
            'text1' => $this->text1,
            'text2' => $this->text2,
            'description1' => $this->description1,
            'description2' => $this->description2,
            'bottom_images' => $this->bottom_images ? array_map(fn($img) => asset($img), $this->bottom_images) : [],
            'status' => (bool)$this->status,
           
        ];
    }
}