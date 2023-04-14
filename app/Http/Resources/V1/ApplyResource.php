<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,
            'FirstName' => $this->FirstName,
            'LastName' => $this->LastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'cv' => $this->cv,

        ];
    }
}
