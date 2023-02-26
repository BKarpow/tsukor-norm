<?php

namespace App\Lib;

trait DateTimeTrait {

    public function dateCreate($format = "d-m-Y H:i")
    {
        return $this->created_at->format($format);
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
