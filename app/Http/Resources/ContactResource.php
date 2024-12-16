<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title1' => $this->title1,
            'title2' => $this->title2,
            'description' => $this->description,
            'number' => $this->number,
           'image1' => $this->image1 ? url('uploads/contact/' . basename($this->image1)) : null,
            'image2' => $this->image2 ? url('uploads/contact/' . basename($this->image2)) : null,
            'image3' => $this->image3 ? url('uploads/contact/' . basename($this->image3)) : null,
            'status' => (bool)$this->status
        ];
    }
}