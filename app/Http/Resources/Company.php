<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BillingAddress as BillingAddressResource;
use App\Http\Resources\DeliveryAddress as DeliveryAddressResource;
use App\BillingAddress;
use App\DeliveryAddress;

class Company extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'abn' => $this->abn,
            'billingAddress' => new BillingAddressResource($this->billingAddress ?: new BillingAddress()),
            'deliveryAddress' => new DeliveryAddressResource($this->deliveryAddress ?: new DeliveryAddress())
        ];
    }
}
