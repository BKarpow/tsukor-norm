<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KetonResource extends JsonResource
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
            'keton' => (bool)$this->keton_body,
            'note' => htmlspecialchars($this->note),
            'time' => $this->dateCreate('H:i'),
            'date' => $this->dateCreate('d.m.Y'),
        ];
    }
}
