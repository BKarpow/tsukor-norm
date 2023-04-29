<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InsulinTakeResource extends JsonResource
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
            'id' => (int) $this->id,
            'insulin' => $this->insulin->name,
            'type' => $this->insulin->type,
            'dose' => round($this->insulin_dose, 1),
            'note' => $this->note,
            'time' => $this->dateCreate('H:s'),
            'date' => $this->dateCreate('d.m.Y'),
        ];
    }
}
