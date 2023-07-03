<?php

namespace App\Lib;

use App\Models\UserWriteHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    /**
     * Метод видаляє запис в історії користувача. Тільки для авторизованих користувачів!
     * @param int $typeWrite - тип запису (ат, рівень глюкози, прийом ліків ...).
     * @param int $idWrite - ід запиму.
     * @return void
     */
    protected function deleteUserHistryFromWriteId(int $typeWrite, int $idWrite): void
    {
        $write = UserWriteHistory::whereUserId(Auth::id())
                ->whereType($typeWrite)
                ->whereWriteId($idWrite)
                ->first();
        if ($write) {
            $id = $write->id;
            $write->delete();
            Log::debug("Write histiry id {$id} - deleted!");
        } else {
            log::debug("Write histiry (type: {$typeWrite}, wrute id: {$idWrite}) - not exists!");
        }
    }
}
