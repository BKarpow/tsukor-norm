<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\DateTimeTrait;

class HbA1c extends Model
{
    use HasFactory;
    use DateTimeTrait;

    public function countLastMoons(): int
    {
        $tm = strtotime($this->created_at);
        $tmNow = time();
        return intval( ($tmNow - $tm) / 2592000 );
    }

    public function countLastDays(): int
    {
        $tm = strtotime($this->created_at);
        $tmNow = time();
        return intval( (($tmNow - $tm) % 2592000) / 86400 );
    }
}
