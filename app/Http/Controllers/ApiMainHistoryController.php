<?php

namespace App\Http\Controllers;

use App\Http\Resources\BloodPressureResource;
use App\Http\Resources\GlucoseResource;
use App\Http\Resources\InsulinTakeResource;
use App\Http\Resources\KetonResource;
use App\Http\Resources\MedicamentsResource;
use App\Http\Resources\SugarTargetRangeResource;
use App\Models\UserWriteHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiMainHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function glucoseForDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);
        $keton = Auth::user()->keton()
                        ->whereRaw("DATE(created_at) = '{$request->date}'")
                        ->orderByRaw('TIME(created_at) desc')
                        ->first();
        $keton = $keton ? new KetonResource($keton) : false;
        return response()->json([
            'date' => $request->date,
            'targetRange' => new SugarTargetRangeResource(
                Auth::user()->sugarTargetRange()->first()
            ),
            'glucose' => GlucoseResource::collection(
                Auth::user()->mySugar()
                ->whereRaw("DATE(created_at) = '{$request->date}'")
                ->orderByRaw('TIME(created_at) ASC')
                ->get()
            ),
            'insulin' => InsulinTakeResource::collection(
                Auth::user()->insulinLog()
                ->whereRaw("DATE(created_at) = '{$request->date}'")
                ->orderByRaw('TIME(created_at) ASC')
                ->get()
            ),
            'medicaments' => MedicamentsResource::collection(
                Auth::user()->medTake()
                ->whereRaw("DATE(created_at) = '{$request->date}'")
                ->orderByRaw('TIME(created_at) ASC')
                ->get()
            ),
            'bloodPressure' => BloodPressureResource::collection(
                Auth::user()->bloodPressure()
                ->whereRaw("DATE(created_at) = '{$request->date}'")
                ->orderByRaw('TIME(created_at) ASC')
                ->get()
            ),
            'keton' => $keton,
        ]);
    }

    private function seedDataToHistory($data, int $type)
    {
        foreach($data as $item) {
            $ei = Auth::user()->history()->whereWriteId($item->id)->first();
            if (!$ei) {
                UserWriteHistory::insert([
                    'user_id' => Auth::id(),
                    'write_id' => $item->id,
                    'type' => $type,
                    'note' => 'Synchronic exporter v1',
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ]);
            }
        }
    }

    public function syncToHistory()
    {
        $this->seedDataToHistory(Auth::user()->mySugar()->get(), UserWriteHistory::TYPE_GLUCOSE );
        $this->seedDataToHistory(Auth::user()->insulinLog()->get(), UserWriteHistory::TYPE_INSULIN_TAKE );
        $this->seedDataToHistory(Auth::user()->medTake()->get(), UserWriteHistory::TYPE_MEDICAMENT_TAKE );
        $this->seedDataToHistory(Auth::user()->bloodPressure()->get(), UserWriteHistory::TYPE_BLOOD_PRESSURE );
        return redirect()->route('home')->withStatus('Синхронізація з історією пройшла успішно!');
    }
}
