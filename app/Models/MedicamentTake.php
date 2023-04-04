<?php

namespace App\Models;

use App\Lib\DateTimeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicamentTake extends Model
{
    use HasFactory;
    use DateTimeTrait;
    public function med()
    {
        return $this->hasOne( Medicament::class , 'id', 'med_id');
    }
}
