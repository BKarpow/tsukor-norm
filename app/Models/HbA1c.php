<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\DateTimeTrait;

class HbA1c extends Model
{
    use HasFactory;
    use DateTimeTrait;

    const HBA1C_MAX_DIABET = 7.0;
    const HBA1C_MAX = 5.7;
    const HBA1C_INTERVAL_DAYS = 90;

    public function countLastMoons(): int
    {
        $tm = strtotime($this->created_at);
        $tmNow = time();
        return intval( ($tmNow - $tm) / 2592000 );
    }

    public function countLastFullDays(): int
    {
        $tm = strtotime($this->created_at);
        $tmNow = time();
        return intval( ($tmNow - $tm) / 86400 );
    }

    public function countLastDays(): int
    {
        $tm = strtotime($this->created_at);
        $tmNow = time();
        return intval( (($tmNow - $tm) % 2592000) / 86400 );
    }

    /**
     * Метод перевірить чи перевищує покащник hba1c максимальне значення для людей з діабетом.
     * @return bool
     */
    public function exceedingNormDiabet():bool
    {
        return $this->percentage >= self::HBA1C_MAX_DIABET;
    }

    /**
     * Метод перевірить чи минуло 3 місяці після останнього вимірювання.
     * @return bool
     */
    public function exceedingIntervalDays():bool
    {
        return $this->countLastFullDays() >= self::HBA1C_INTERVAL_DAYS;
    }
}
