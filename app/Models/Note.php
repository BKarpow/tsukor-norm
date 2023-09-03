<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    function shortText($leght = 50, $end = "...") : string
    {
        $text = strip_tags($this->text);
        if (mb_strlen($text) > $leght) {
            return mb_substr($text, 0, $leght) . $end;
        }
        return $text;
    }
}
