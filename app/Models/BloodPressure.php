<?php

namespace App\Models;
use App\Lib\DateTimeTrait;
use App\Lib\BloodPressureToolTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodPressure extends Model
{
    use HasFactory;
    use DateTimeTrait;
    use BloodPressureToolTrait;

}
