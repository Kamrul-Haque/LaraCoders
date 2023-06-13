<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable
     */
    public function toArray($request): array
    {
        return [
            'book' => new BookResource($this->book),
            'quantity' => $this->quantity,
            'price' => $this->price,
            'vat' => $this->vat,
            'total_price' => $this->price + $this->vat
        ];
    }
}
