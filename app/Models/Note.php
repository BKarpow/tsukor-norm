<?php

namespace App\Models;

use App\Lib\DateTimeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    use DateTimeTrait;

    function shortText($leght = 50, $end = "...") : string
    {
        $text = strip_tags($this->text);
        if (mb_strlen($text) > $leght) {
            return mb_substr($text, 0, $leght) . $end;
        }
        return $text;
    }
}
