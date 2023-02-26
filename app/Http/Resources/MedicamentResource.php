<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicamentResource extends JsonResource
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

            'id' => intval($this->id),
            'name' => htmlspecialchars($this->name),
            'dose' => htmlspecialchars($this->dose),
            'note' => htmlspecialchars($this->note),
        ];
    }
}
