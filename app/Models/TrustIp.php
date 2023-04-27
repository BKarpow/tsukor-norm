<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrustIp extends Model
{
    use HasFactory;
    private array $dontTrustCountry = [
        'RU',
        'ru',
        'rus',
        'RUS'
    ];
}
