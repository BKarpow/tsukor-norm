<?php

namespace App\Http\Controllers;

use App\Models\IndexGlucose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControlProductIgController extends Controller
{
    public function __construct()
    {
        //
    }

    public function showList()
    {
        return view('admin.ig.index', [
            'products' => IndexGlucose::orderBy('public', 'asc')->paginate(50),
        ]);
    }

    public function publicTrigger(IndexGlucose $indexGlucose)
    {
        $msg = "Публікація ({$indexGlucose->id}, '{$indexGlucose->food}') - ";
        $indexGlucose->public = !$indexGlucose->public;
        $msg .= $indexGlucose->public ? "дозволена." : "відізвана.";
        $indexGlucose->save();
        return redirect()->route('admin.product')->withStatus($msg);
    }


}
