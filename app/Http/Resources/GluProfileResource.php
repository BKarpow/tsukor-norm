<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\MySugar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GluProfileResource extends JsonResource
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
            'date' => $this->dateCreate('d.m.Y'),
            'dateSystem' => $this->dateCreate('Y-m-d'),
            'set' => Auth::user()
                        ->mySugar()
                        ->select('glucose', DB::raw('TIME(created_at) as time'))
                        ->where(DB::raw('DATE(created_at)'), $this->dateCreate('Y-m-d'))
                        ->get(),
        ];
    }
}
