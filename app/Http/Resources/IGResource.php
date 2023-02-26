<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class IGResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $data = [
            'id' => $this->id,
            'food' => $this->food,
            'ig' => $this->ig,
            'url' => $this->url,
            'one_ho_count' => $this->one_ho_count,
            'one_ho_unit' => $this->one_ho_unit,
            'protein' => $this->protein,
            'fats' => $this->fats,
            'carbohydrates' => $this->carbohydrates,
            'calories' => $this->calories,
            'desc' => $this->description_food,
            'auth' => false,
            'admin' => false,

        ];
        if (Auth::check()) {
            $data['auth'] = true;
            if (Auth::user()->isAdmin()) {
                $data['link_edit'] = route('ig.edit', ['indexGlucose' => $this->id]);
                $data['admin'] = true;
            }
        }

        return $data;
    }
}
