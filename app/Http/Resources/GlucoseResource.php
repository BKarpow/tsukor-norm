<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GlucoseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id" => (int)$this->id,
            "glucose" => $this->glucoseLevel(),
            "beforeFood" => (bool)$this->before_food,
            "afterFood" => (bool)$this->after_food,
            "stress" => (bool)$this->stress,
            "beforeExercise" => (bool)$this->before_exercise,
            "exercise" => (bool)$this->exercise,
            "afterExercise" => (bool)$this->after_exercise,
            "disease" => (bool)$this->disease,
            "note" => htmlspecialchars($this->comment),
            'time' => $this->dateCreate("H:i"),
            'date' => $this->dateCreate("d.m.Y"),
        ];
    }
}
