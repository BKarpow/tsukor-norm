<?php

namespace App\Http\Controllers;

use App\Models\Keton;
use App\Http\Requests\StoreKetonRequest;
use App\Http\Requests\UpdateKetonRequest;
use Illuminate\Support\Facades\Auth;

class KetonController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('keton.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKetonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKetonRequest $request)
    {
        $keton = new Keton();
        $keton->user_id = Auth::id();
        $keton->keton_body = $request->keton == "on" ? true : false;
        $keton->note = $request->input('note', "");
        $keton->created_at = $request->created_at;
        $keton->save();
        return redirect()->route('home')->withStatus("Результат тесту на кетонові тіла збережено.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keton  $keton
     * @return \Illuminate\Http\Response
     */
    public function show(Keton $keton)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keton  $keton
     * @return \Illuminate\Http\Response
     */
    public function edit(Keton $keton)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKetonRequest  $request
     * @param  \App\Models\Keton  $keton
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKetonRequest $request, Keton $keton)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keton  $keton
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keton $keton)
    {
        //
    }
}
