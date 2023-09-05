<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotePanelResource extends JsonResource
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
            'title' => trim(strip_tags($this->title)),
            'short' => $this->shortText(),
            'text'  => trim(strip_tags($this->text)),
            'time'  => $this->dateUpdate('H:i'),
        ];
    }
}
