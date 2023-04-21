<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'client_id'=>$this->client_id,
            'owner_id'=>$this->owner_id,
            'client'=>$this->client,
            'owner'=>$this->owner,
            'messages'=>MessagesResource::collection($this->messages)
        ];
    }
}
