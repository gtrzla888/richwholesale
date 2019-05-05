<?php

namespace App\Http\Resources;

use App\Http\Resources\Shutter as ShutterResource;
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
            'customer_name' => $this->customer_name,
            'po_reference' => $this->po_reference,
            'notes' => $this->notes,
            'basswood_shutters' => $this->basswood_shutters,
            'pvc_shutters' => $this->pvc_shutters,
            'au_pvc_shutters' => $this->au_pvc_shutters,
            'aluminium_shutters' => $this->aluminium_shutters,
            'roller_blinds' => $this->roller_blinds
        ];
    }
}
