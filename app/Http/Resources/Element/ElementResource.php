<?php

namespace App\Http\Resources\Element;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title" => $this->title,
            "count" => $this->count,
            "price" => $this->price,
            "article" => $this->article,
            "description" => $this->description,
            "brand" => $this->brand,
            "volume" => $this->volume,
        ];
    }
}
