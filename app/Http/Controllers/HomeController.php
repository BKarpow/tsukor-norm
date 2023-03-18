<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Lib\PdfExportTrait;

class HomeController extends Controller
{
    use PdfExportTrait;
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
        $avgPerDay = DB::table('my_sugar')
                        ->select(DB::raw('AVG(count_per_day)'))
                        ->from(function ($query) {
                            $query->select(DB::raw('COUNT(*) as count_per_day'))
                                ->from('my_sugar')
                                ->whereUserId(Auth::id())
                                ->groupBy(DB::raw('DATE(created_at)'));
                        }, 'daily_counts')
                        ->value('AVG(count_per_day)');
        $sugarTargetRange = Auth::user()->sugarTargetRange()->first();
        $sugarAvg = Auth::user()->mySugar()->avg('glucose');
        $sugarAvg = round($sugarAvg, 1);
        $sugarCount = Auth::user()->mySugar()->count();
        $last7Day = Auth::user()->mySugar()->where('created_at', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 7 DAY)'))->avg('glucose');
        $last14Day = Auth::user()->mySugar()->where('created_at', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 14 DAY)'))->avg('glucose');
        $last30Day = Auth::user()->mySugar()->where('created_at', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 30 DAY)'))->avg('glucose');
        $last90Day = Auth::user()->mySugar()->where('created_at', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 90 DAY)'))->avg('glucose');

        return view('home', [
            'avgPerDay' => round($avgPerDay, 1),
            'sugarTargetRange' => $sugarTargetRange,
            'last7Day' => round( $last7Day, 1),
            'avgGluToDay' => round(  Auth::user()->mySugar()->where(DB::raw('DATE(created_at)'), DB::raw(' DATE(NOW())'))->avg('glucose'), 1),
            'last14Day' => round( $last14Day, 1),
            'last30Day' => round( $last30Day, 1),
            'last90Day' => round( $last90Day, 1),
            'sugarAvg' => $sugarAvg,
            'sugarCount' => $sugarCount,
            'sugars' => Auth::user()->mySugar()
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(15),
            'medicaments' => Auth::user()->medicaments()
                                         ->orderBy('name', 'asc')
                                         ->get()
        ]);
    }

    public function pdfExport()
    {
        return view('pdfExport', [
            'pdfList' => $this->getListMyPdfFiles(),
        ]);
    }

    public function pdfExportStore(Request $request)
    {
        $request->validate([
            'startDate'=>'required|date_format:Y-m-d',
            'endDate'=>'required|date_format:Y-m-d',
        ]);
        $allDates = Auth::user()->mySugar()
        ->select(DB::raw('DATE(created_at) as `date`, COUNT(created_at) as count'))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('created_at', 'desc')
        ->get();
        // DB::enableQueryLog();
        $data = Auth::user()->mySugar()
                    ->select(DB::raw('ROUND(glucose, 1) as glucose, DATE(created_at) as `date`, TIME(created_at) as `time`, before_food, after_food'))
                    ->orderBy('created_at', 'desc')
                    ->whereRaw("DATE(created_at) >= '{$request->startDate}'")
                    ->whereRaw("DATE(created_at) <= '{$request->endDate}'")
                    ->get();
        // $queries = DB::getQueryLog();
        // dd($queries);
        $pdfContent = $this->writerDataPdf($data, $allDates);
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$this->pdfFileName.'"'
        ];
        return response($pdfContent, 200, $headers);
    }

    public function pdfDownload($pdfName)
    {
        if (!file_exists($this->getPdfDirPath().$pdfName)) {
            abort(404);
        }
        $pdfContent = file_get_contents($this->getPdfDirPath().$pdfName);
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$pdfName.'"'
        ];
        return response($pdfContent, 200, $headers);
    }
}
