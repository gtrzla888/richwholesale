<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Company as CompanyResource;

class User extends JsonResource
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
          'email' => $this->email,
          'role' => $this->role,
          'isWholesaleAdmin' => $this->isWholesaleAdmin,
          'isWholesaleUser' => $this->isWholesaleUser,
          'isCompanyUser' => $this->isCompanyUser,
          'isCompanyAdmin' => $this->isCompanyAdmin,
          'companies' => CompanyResource::collection($this->companies),
        ];
    }
}
