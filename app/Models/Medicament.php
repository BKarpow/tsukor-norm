<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\DateTimeTrait;

class Medicament extends Model
{
    use HasFactory;
    use DateTimeTrait;
}
