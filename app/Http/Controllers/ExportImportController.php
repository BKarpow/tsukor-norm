<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExportImportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function getData():array
    {
        return [
            'mySugars' =>  Auth::user()->mySugar()
                            ->orderBy('created_at', 'desc')
                            ->get(),
            'bloodPressure' => Auth::user()->bloodPressure()
                                ->orderBy('created_at', 'desc')
                                ->get(),
            'hba1c' => Auth::user()->hba1c()
                                ->orderBy('created_at', 'desc')
                                ->get(),
            'medicaments' => Auth::user()->medicaments()
                                ->orderBy('created_at', 'desc')
                                ->get(),
            'medicamentTake' => Auth::user()->medTake()
                                ->orderBy('created_at', 'desc')
                                ->get(),
            'insulin' => Auth::user()->insulin()
                                ->orderBy('created_at', 'desc')
                                ->get(),
            'insulinTake' => Auth::user()->insulinLog()
                                ->orderBy('created_at', 'desc')
                                ->get(),
            'notes' => Auth::user()->notes()
                                ->orderBy('created_at', 'desc')
                                ->get(),
        ];
    }

    public function getJson()
    {
        $jsonFileName = date('Y-m-d_H-i-s')."_export_tsukor-norm.json";
        $jsonContent = json_encode($this->getData());
        return response($jsonContent, 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="'.$jsonFileName.'"'
        ]);
    }
}
