<?php

namespace App\Lib;

use Illuminate\Support\Facades\Auth;

trait HistoryServicesTrait {

    /**
     * Метод поверне історію всіх записів користувача.
     *
     */
    protected function getAllDatesFromHistory()
    {
       return Auth::user()->history()
                            ->selectRaw('DATE(created_at) as created_at')
                            ->groupBYRaw('DATE(created_at)')
                            ->orderByRaw('DATE(created_at) desc')
                            ->paginate(env('PAGINATE_PERPAGES_HISTRORY', 20));
    }
}
