<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MySugar extends Model
{
    use HasFactory;

    public function dateCreate($format = "d-m-Y H:i")
    {
        return date($format, strtotime($this->created_at));
    }

    public function dateUpdate($format = "d-m-Y H:i")
    {
        return $this->updated_at->format($format);
    }

    public function glucoseLevel(): float
    {
        return round((float)$this->glucose, 1);
    }
}
