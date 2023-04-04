<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\DateTimeTrait;

class InsulinTake extends Model
{
    use HasFactory;
    use DateTimeTrait;

    public function insulin()
    {
        return $this->hasOne(Insulin::class, 'id', 'insulin_id');
    }
}
