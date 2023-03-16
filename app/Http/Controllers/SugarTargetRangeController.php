<?php

namespace App\Http\Controllers;

use App\Http\Requests\SugarTargetRangeRequest;
use App\Http\Resources\SugarTargetRangeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SugarTargetRange;

class SugarTargetRangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getLastApi()
    {
        $last = Auth::user()->sugarTargetRange()
                        ->orderBy('created_at', 'desc')
                        ->first();
        if (!$last) {
            return response()->json([
                'status' => false,
                'str' => null,
            ]);
        }
        return response()->json([
                'status' => true,
                'str' => new SugarTargetRangeResource($last),
            ]);
    }

    public function storeOrUpdateApi(SugarTargetRangeRequest $request)
    {
       $last = Auth::user()->sugarTargetRange()
                        ->orderBy('created_at', 'desc')
                        ->first();
        if (!$last) {
            $str = new SugarTargetRange();
            $str->user_id = Auth::id();
            $str->min_glu = $request->min_glu;
            $str->max_glu = $request->max_glu;
            $str->min_nt_glu = $request->min_nt_glu;
            $str->max_nt_glu = $request->max_nt_glu;
            $str->save();
            return response()->json([
                'status' => true,
                'type' => 'store',
                'sugarTargetRange' => new SugarTargetRangeResource($str)
            ]);
        } else {
            $last->min_glu = $request->min_glu;
            $last->max_glu = $request->max_glu;
            $last->min_nt_glu = $request->min_nt_glu;
            $last->max_nt_glu = $request->max_nt_glu;
            $last->save();
            return response()->json([
                'status' => true,
                'type' => 'update',
                'sugarTargetRange' => new SugarTargetRangeResource($last)
            ]);
        }
    }
}
