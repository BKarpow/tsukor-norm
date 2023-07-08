<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Lib\PdfExportTrait;
use App\Lib\BridgeWordPressAuthTrait;
use App\Lib\HistoryServicesTrait;
use App\Lib\SugarServicesTrait;

class HomeController extends Controller
{
    use PdfExportTrait;
    use BridgeWordPressAuthTrait;
    use SugarServicesTrait, HistoryServicesTrait;
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
        return view('home', [
            'sugarTargetRange' => $this->getSuagarTarrgetRange(),
            'avgPerDay' => $this->getAvgCountLevelsSugarFrom7Days(),
            'sugars' => $this->getAllDatesFromHistory(),
            'hba1c' => Auth::user()->hba1c()->orderBy('created_at','desc')->first()
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

    public function pdfDelete($pdfName)
    {
        if (!file_exists($this->getPdfDirPath().$pdfName)) {
            abort(404);
        }
        return response()->json([
            'status' => (bool)unlink($this->getPdfDirPath().$pdfName),
            'info' => "Файл експорту {$pdfName} видалено"
        ]);
    }
}
