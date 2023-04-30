<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\DateTimeTrait;

class UserWriteHistory extends Model
{
    use HasFactory;
    use DateTimeTrait;

    // Types history items
    const TYPE_GLUCOSE = 1;
    const TYPE_BLOOD_PRESSURE = 2;
    const TYPE_INSULIN_TAKE = 3;
    const TYPE_MEDICAMENT_TAKE = 4;
}
