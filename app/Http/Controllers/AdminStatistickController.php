<?php

namespace App\Http\Controllers;

use App\Models\TrustIp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminStatistickController extends Controller
{
    public function __construct()
    {
        # code
    }

    public function pageVisitors()
    {
        if (Auth::user()->role != 42) {
            die('Only admins access!');
        }
        $vs = TrustIp::orderBy('id', 'desc')->paginate(100);
        return view('admin.visitor.index', [
            'vs' => $vs,
        ]);
    }
}
