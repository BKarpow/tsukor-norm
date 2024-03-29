<?php

namespace App\Lib;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Трейд сервісів для контроллера MySygarController
 */
trait SugarServicesTrait {

    /**
     * Приватний метод для округлення чисел із плаваючою комою.
     * @param float|int $number
     * @return float
     */
    private function getRoundFloat($number): float
    {
        return round((float)$number, 1);
    }

    /**
     * Метод поверне кількість записів про рівень цукру за поточний місяць для користувача.
     * @return int
     */
    protected function getCountSugarFromCurentMonth(): int
    {
        return Auth::user()->mySugar()
            ->whereMonth('created_at', '=', date('m'))
            ->whereYear('created_at', '=', date('Y'))
            ->count();
    }

    /**
     * Метод поверне середню кількість записів про рівень цукру крові користувача за останні 7 двін.
     * @return float
     */
    protected function getAvgCountLevelsSugarFrom7Days(): float
    {
        $now = date('Y-m-d');
        $avg = Auth::user()->mySugar()
                    ->where('created_at', '>=', DB::raw("DATE_SUB('{$now}', INTERVAL 1 WEEK)"))
                    ->count();
        return $this->getRoundFloat( ($avg) / 7 );
    }

    /**
     * Поверне кількімть всіх записів про рівень цукру поточного користувача.
     * @return int
     */
    protected function getCountAllSugar(): int
    {
        return Auth::user()->mySugar()->count();
    }

    /**
     * Метод поверне середній рівень цукру для користувача за сьогодні.
     * @return float
     */
    protected function getAvgFromToDay(): float
    {
        $d = Auth::user()->mySugar()
        ->where(DB::raw('DATE(created_at)'), DB::raw(' DATE(NOW())'))
        ->avg('glucose');
        return $this->getRoundFloat($d);
    }

    /**
     * Метод поверне серенє значення рівня цукру для всіх записів про цукор.
     * @return float
     */
    protected function getAvgFromAllLevelsSugar(): float
    {
        $d = (float)Auth::user()->mySugar()->avg('glucose');
        return $this->getRoundFloat($d);
    }

    /**
     * Метод поверне середній рівень цукру за вказаний в аргументі інтервал днів.
     * @param int $intervalDays
     * @return float
     */
    protected function getAvgFromIntervalDays(int $intervalDays): float
    {
        $intervalDays = intval($intervalDays);
        $d = Auth::user()->mySugar()->where(
                                'created_at',
                                '>',
                                DB::raw("DATE_SUB(NOW(), INTERVAL {$intervalDays} DAY)")
                            )
            ->avg('glucose');
        return $this->getRoundFloat($d);
    }

    /**
     * Метод поверне рівні норм цукру крові для користувача, або нуль.
     * @return App\Models\SugarTarrgetRange|null
     */
    protected function getSuagarTarrgetRange()
    {
        return Auth::user()->sugarTargetRange()->first();
    }

    /**
     * Метод який поверне масив із змінними для сторінки аналітики цукру.
     * @return array
     */
    protected function getArrayCollectionVarsFromAnalytic():array
    {
        return [
            'avgPerDay' => $this->getAvgCountLevelsSugarFrom7Days(), //
            'last7Day' => $this->getAvgFromIntervalDays(7), //
            'avgGluToDay' => $this->getAvgFromToDay(), //
            'last14Day' => $this->getAvgFromIntervalDays(14), //
            'last30Day' => $this->getAvgFromIntervalDays(30), //
            'last90Day' => $this->getAvgFromIntervalDays(90), //
            'sugarAvg' => $this->getAvgFromAllLevelsSugar(), //
            'sugarCount' => $this->getCountAllSugar(), //
            'sugarCountMonth' => $this->getCountSugarFromCurentMonth(), //
        ];
    }

}
