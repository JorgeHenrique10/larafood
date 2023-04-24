<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\TenantResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class OrderResource extends JsonResource
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
            'identify' => $this->identify,
            'total' => $this->total,
            'status' => $this->status,
            'date' => Carbon::make($this->created_at)->format('Y-m-d'),
            'company' => new TenantResource($this->tenant),
            'client' =>  $this->client_id ? new ClientResource($this->client) : null,
            'table' => $this->table_id ? new TableResource($this->table) : null,
            'products' => ProductResource::collection($this->products),
            'evaluations' => EvaluationOrderResource::collection($this->evaluations)
        ];
    }
}
