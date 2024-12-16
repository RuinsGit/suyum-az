<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TranslationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'logo' => $this->logo ? asset($this->logo) : null,
            'text1' => $this->text1,
            'text2' => $this->text2,
            'text3' => $this->text3,
            'text4' => $this->text4,
            'text5' => $this->text5,
            'text6' => $this->text6,
            'text7' => $this->text7,
            'text8' => $this->text8,
            
           
        ];
    }
}