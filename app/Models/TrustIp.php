<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrustIp extends Model
{
    use HasFactory;
    static array $notTrustCountry = [
        'RU',
        'ru',
        'rus',
        'RUS'
    ];
}
