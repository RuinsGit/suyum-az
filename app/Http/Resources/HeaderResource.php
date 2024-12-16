<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeaderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'home' => $this->home,
            'about' => $this->about,
            'products' => $this->products,
            'services' => $this->services,
            'projects' => $this->projects,
            'certificates' => $this->certificates,
            'customers' => $this->customers,
            'contact' => $this->contact,
            'status' => (bool)$this->status
        ];
    }
}