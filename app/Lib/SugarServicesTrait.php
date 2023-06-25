<?php

namespace App\Lib;

use Illuminate\Support\Facades\Auth;

/**
 * Трейд сервісів для контроллера MySygarController
 */
trait SugarServicesTrait {

    /**
     * Метод поверне кількість записів про рівень цукру за поточний місяць.
     * @return int
     */
    protected function getCountSugarFromCurentMonth(): int
    {
        return Auth::user()->mySugar()
            ->whereMonth('created_at', '=', date('m'))
            ->whereYear('created_at', '=', date('Y'))
            ->count();
    }
}
