<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_number' => $this->order_number,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'customer_phone' => $this->customer_phone,
            'customer_address_line_1' => $this->customer_address_line_1,
            'customer_address_line_2' => $this->customer_address_line_2 ? $this->customer_address_line_2 : 'Not Given',
            'customer_postcode' => $this->customer_postcode,
            'customer_city' => $this->customer_postcode,
            'customer_country' => $this->customer_country,
            'items' => OrderItemResource::collection($this->whenLoaded('order_items')),
            'delivery_charge' => $this->delivery_charge,
            'total_vat' => $this->total_vat,
            'discount' => $this->discount,
            'sub_total' => $this->sub_total,
            'grand_total' => $this->grand_total,
        ];
    }
}
