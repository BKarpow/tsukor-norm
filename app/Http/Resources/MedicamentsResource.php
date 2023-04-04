<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicamentsResource extends JsonResource
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
            'name' => $this->med->name,
            'sugarLower' => (bool)$this->med->sugar_lower,
            'dose' => $this->dose,
            'tabletDose' => $this->med->dose,
            'note' => htmlspecialchars($this->note),
            'time' => $this->dateCreate('H:i'),
            'date' => $this->dateCreate('d.m.Y'),
        ];
    }
}
