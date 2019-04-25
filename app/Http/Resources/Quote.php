<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Quote extends JsonResource
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
            'company_id' => $this->company->id,
            'basswood_shutters' => [],
            'customer_name' => [],
        ];
    }
}
