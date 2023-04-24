<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'flag' => $this->flag,
            'title' => $this->title,
            'image' => $this->image ? url("storage/$this->image") : '',
            'price' => $this->price,
            'description' => $this->description
        ];
    }
}
