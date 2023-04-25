<?php

namespace App\Http\Controllers;

use App\Http\Resources\BloodPressureResource;
use App\Http\Resources\GlucoseResource;
use App\Http\Resources\InsulinTakeResource;
use App\Http\Resources\KetonResource;
use App\Http\Resources\MedicamentsResource;
use App\Http\Resources\SugarTargetRangeResource;

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
}
