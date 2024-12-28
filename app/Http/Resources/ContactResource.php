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
            'filial_name' => $this->name,
            'number' => $this->number,
            'email' => $this->email,
            'address' => $this->address,
            'number_image' => $this->number_image ? asset($this->number_image) : null,
            'address_image' => $this->address_image ? asset($this->address_image) : null,
            'email_image' => $this->email_image ? asset($this->email_image) : null,
            'filial_map' => $this->filial_text,
            'status' => (bool)$this->status,
        ];
    }
}