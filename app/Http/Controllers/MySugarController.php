<?php

namespace App\Http\Controllers;

use App\Models\MySugar;
use App\Http\Requests\StoreMySugarRequest;
use App\Http\Requests\SugarImportFileUploadRequest;
use App\Http\Requests\UpdateMySugarRequest;
use App\Http\Resources\GluProfileResource;
use App\Http\Resources\SugarAnalyticApiResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MySugarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return view('sugar.import');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sugar.add');
    }

    public function importStore(SugarImportFileUploadRequest $request)
    {
        $name = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->store('public/files');
        $importData = json_decode(file_get_contents(storage_path("/app/".$path)), true);
        $startTime = microtime(true);
        $infDelOld = ".";
        if((bool)$request->clear_old){
            $countOld = MySugar::whereUserId(Auth::id())->count();
            MySugar::whereUserId(Auth::id())->delete();
            $infDelOld = ". Видалено {$countOld} попередніх записів виміру.";
        }
        foreach($importData['apLogs'] as $item ) {
            $date = date("Y-m-d H:i:s", strtotime($item['dateTime']));
            if (!Auth::user()->bloodPressure()->whereCreatedAt($date)->first()){
                Auth::user()->bloodPressure()->insert([
                    "user_id" => Auth::id(),
                    "sis" => $item['systolic'],
                    "dis" => $item['diastolic'],
                    "pulse" => $item['pulse'],
                    "note" => $item['note'],
                    "created_at" => $date,
                    "updated_at" => now()
                ]);
            }
        }
        $iter = 0;
        foreach($importData['glucoseLogs'] as $item ) {
            $date = date("Y-m-d H:i:s", strtotime($item['dateTime']));
            $beforeFood = false;
            $afterFood = false;
            if ($item['measured'] == 0 || $item['measured'] == 2 || $item['measured'] == 4){
                $beforeFood = true;
                $afterFood = false;
            }elseif($item['measured'] == 1 || $item['measured'] == 3 || $item['measured'] == 5){
                $beforeFood = false;
                $afterFood = true;
            }
            $data = [
                'user_id' => Auth::id(),
                'glucose' => $item['valueMmol'],
                'before_food' => $beforeFood,
                'after_food' => $afterFood,
                'comment' => $item['note'],
                'created_at' => $date,
                "updated_at" => now()
            ];
            if ((bool)$request->uniq_glu &&
                 !Auth::user()->mySugar()->whereCreatedAt($date)->first()){
                    $iter++;
                    MySugar::insert($data);
                 } elseif(!(bool)$request->uniq_glu) {
                    $iter++;
                    MySugar::insert($data);
                 }
        }
        $importTime = round(( microtime(true) - $startTime) , 2);
        // Delete file import
        unlink(storage_path("/app/".$path));
        return redirect()
                    ->route('home')
                    ->withStatus(
                        "Імпортовано {$iter} показників за {$importTime}сек".$infDelOld
                    );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMySugarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMySugarRequest $request)
    {
        $comment = ($request->comment) ? $request->comment : "Sugar in blood";
        MySugar::insert([
            "user_id" => Auth::id(),
            "glucose" => (float)$request->glucose,
            "before_food" => (bool)$request->before_food,
            "after_food" => (bool)$request->after_food,
            "before_exercise" => (bool)$request->before_exercise,
            "exercise" => (bool)$request->exercise,
            "after_exercise" => (bool)$request->after_exercise,
            "stress" => (bool)$request->stress,
            "disease" => (bool)$request->disease,
            "comment" => $comment,
            "created_at" => $request->created_at,
            "updated_at" => now()
        ]);
        return redirect()->route('home')->withStatus("Показник цукру збережено");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MySugar  $mySugar
     * @return \Illuminate\Http\Response
     */
    public function show(MySugar $mySugar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MySugar  $mySugar
     * @return \Illuminate\Http\Response
     */
    public function edit(MySugar $mySugar)
    {
        $this->authorize('delete', $mySugar);
        return view('sugar.edit', ['s'=>$mySugar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMySugarRequest  $request
     * @param  \App\Models\MySugar  $mySugar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMySugarRequest $request, MySugar $mySugar)
    {
        $this->authorize('delete', $mySugar);
        $comment = ($request->comment) ? $request->comment : "...";
        $mySugar->glucose = (float)$request->glucose;
        $mySugar->before_food = (bool)$request->before_food;
        $mySugar->after_food = (bool)$request->after_food;
        $mySugar->before_exercise = (bool)$request->before_exercise;
        $mySugar->exercise = (bool)$request->exercise;
        $mySugar->after_exercise = (bool)$request->after_exercise;
        $mySugar->stress = (bool)$request->stress;
        $mySugar->disease = (bool)$request->disease;
        $mySugar->comment = $comment;
        $mySugar->save();
        return redirect()->route('home')->withStatus("Показник цукру збережено");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MySugar  $mySugar
     * @return \Illuminate\Http\Response
     */
    public function destroy(MySugar $mySugar)
    {
        $this->authorize('delete', $mySugar);
        $cr = $mySugar->dateCreate();
        $info = "Видалено показник глюкози {$mySugar->glucose}ммол/л, який створено {$cr}";
        $mySugar->delete();
        return response()->json([
            'info' => $info
        ]);
    }

    public function getAnalyticsDataSugarApi(Request $request)
    {
        $data = $request->validate([
            'range' => 'required|numeric|max:180|min:7'
        ]);
        $intervalDays = (int)$data['range'];
        $avgSugar = Auth::user()->mySugar()
                            ->select(DB::raw(' AVG(`glucose`) as glucose, DATE(`created_at`) as created_at'))
                            ->groupBy(DB::raw('DATE(`created_at`)'))
                            ->where('created_at', '>=', DB::raw("DATE_SUB(NOW(), INTERVAL {$intervalDays} DAY)"))
                            ->orderBy('created_at', 'asc')
                            ->get();
        return SugarAnalyticApiResource::collection($avgSugar);

    }

    public function getLevelsPercentageApi()
    {
        $tr = Auth::user()->sugarTargetRange()->first();
        $cgAll = Auth::user()->mySugar()->count();
        $cgAllMin = Auth::user()
                        ->mySugar()
                        ->where('glucose', '<=', $tr->min_glu)
                        ->count();
        $cgAllNorm = Auth::user()
                        ->mySugar()
                        ->where('glucose', '<=', $tr->max_glu)
                        ->where('glucose', '>=', $tr->min_glu)
                        ->count();
        $cgAllMax = Auth::user()
                        ->mySugar()
                        ->where('glucose', '>=', $tr->max_glu)
                        ->count();
        $perOne = ($cgAll != 0) ? ($cgAll / 100) : 0 ;
        $rd = 1;
        return response()->json([
            'c' => $cgAll,
            'cgAllMax' => $cgAllMax,
            'cgAllMin' => $cgAllMin,
            'cgAllNorm' => $cgAllNorm,
            'maxPer' => round(($cgAllMax / $perOne), $rd),
            'minPer' => round(($cgAllMin / $perOne), $rd),
            'perNorm' => round(($cgAllNorm / $perOne), $rd),

        ]);
    }

    public function getEmptyStomachApi(Request $request)
    {
        $data = $request->validate([
            'range' => 'required|numeric|max:180|min:7'
        ]);
        $intervalDays = (int)$data['range'];
        $eq = Auth::user()->mySugar()->where([
                    [DB::raw('TIME(created_at)'), '>=', '04:00:00'],
                    [DB::raw('TIME(created_at)'), '<=', '07:00:00'],
                    ['before_food', 1],
                    ['created_at', '>=', DB::raw("DATE_SUB(NOW(), INTERVAL {$intervalDays} DAY)")]
                ])
                ->orderBy('created_at', 'asc');
        return response()->json([
            'sugars' => SugarAnalyticApiResource::collection($eq->get()),
            'avg' => round( $eq->avg('glucose'), 1)
        ]);
    }

    public function gluProfileApi()
    {
        return GluProfileResource::collection(
            Auth::user()
            ->mySugar()
            ->select(DB::raw('DATE(created_at) as created_at'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get()
        );
    }
}
