<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sugarTargetRange = Auth::user()->sugarTargetRange()->first();
        $sugarAvg = Auth::user()->mySugar()->avg('glucose');
        $sugarAvg = round($sugarAvg, 1);
        $sugarCount = Auth::user()->mySugar()->count();
        $last7Day = Auth::user()->mySugar()->where('created_at', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 7 DAY)'))->avg('glucose');
        $last14Day = Auth::user()->mySugar()->where('created_at', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 14 DAY)'))->avg('glucose');
        $last30Day = Auth::user()->mySugar()->where('created_at', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 30 DAY)'))->avg('glucose');
        $last90Day = Auth::user()->mySugar()->where('created_at', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 90 DAY)'))->avg('glucose');
        return view('home', [
            'sugarTargetRange' => $sugarTargetRange,
            'last7Day' => round( $last7Day, 1),
            'last14Day' => round( $last14Day, 1),
            'last30Day' => round( $last30Day, 1),
            'last90Day' => round( $last90Day, 1),
            'sugarAvg' => $sugarAvg,
            'sugarCount' => $sugarCount,
            'sugars' => Auth::user()->mySugar()
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(50),
            'medicaments' => Auth::user()->medicaments()
                                         ->orderBy('name', 'asc')
                                         ->get()
        ]);
    }
}
