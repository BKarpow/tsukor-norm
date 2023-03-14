<?php

namespace App\Http\Controllers;

use App\Models\HbA1c;
use App\Http\Requests\StoreHbA1cRequest;
use App\Http\Requests\UpdateHbA1cRequest;
use Illuminate\Support\Facades\Auth;

class HbA1cController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hba1c.index', [
            'hba1cs' => Auth::user()->hba1c()->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hba1c.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHbA1cRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHbA1cRequest $request)
    {
        HbA1c::insert([
            'user_id' => Auth::id(),
            'percentage' => $request->percentage,
            'note' => $request->note,
            'created_at' => $request->created_at,
            'updated_at' => now(),
        ]);
        return redirect()->route('hba1c.index')->withStatus("Додано новий показник HbA1c");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HbA1c  $hbA1c
     * @return \Illuminate\Http\Response
     */
    public function show(HbA1c $hbA1c)
    {
        $this->authorize('view', $hbA1c);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HbA1c  $hbA1c
     * @return \Illuminate\Http\Response
     */
    public function edit(HbA1c $hbA1c)
    {
        $this->authorize('view', $hbA1c);
        return view('hba1c.update', [
            'hba1c' => $hbA1c,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHbA1cRequest  $request
     * @param  \App\Models\HbA1c  $hbA1c
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHbA1cRequest $request, HbA1c $hbA1c)
    {
        $this->authorize('view', $hbA1c);
        $hbA1c->percentage = $request->percentage;
        $hbA1c->note = $request->note;
        $hbA1c->created_at = $request->created_at;
        $hbA1c->save();
        return redirect()->route('hba1c.index')->withStatus("Оновлено показник HbA1c");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HbA1c  $hbA1c
     * @return \Illuminate\Http\Response
     */
    public function destroy(HbA1c $hbA1c)
    {
        $this->authorize('view', $hbA1c);
        $hb = (int) $hbA1c->id;
        $hbA1c->delete();
        return response()->json([
            'status' => true,
            'deletedId' => $hb
        ]);
    }
}
