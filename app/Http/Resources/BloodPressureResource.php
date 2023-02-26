<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BloodPressureResource extends JsonResource
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
            'id' => (int)$this->id,
            'sis' => (int)$this->sis,
            'dis' => (int)$this->dis,
            'pulse' => (int)$this->pulse,
            'isNormalPressure' => $this->isNormalPressure(),
            'isNormalPulse' => $this->isNormalPulse(),
            'note' => $this->note,
            'time' => $this->dateCreate('H:i'),
            'date' => $this->dateCreate('d.m.Y'),
            'timestamp' => $this->created_at,
        ];
    }
}
