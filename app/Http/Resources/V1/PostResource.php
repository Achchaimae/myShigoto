<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        // you can also return a custom array
        // return [
        //     'id' => $this->id,
        //     'title' => $this->title,
        //     'description' => $this->description,
        //     'tag' => $this->tag,
        //     'city' => $this->city,
        //     'type_of_post' => $this->type_of_post,
        //     'image' => $this->image,
        //     ];
    }
}
