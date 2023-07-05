<?php

namespace App\Http\Controllers;

use App\Models\HbA1c;
use App\Http\Requests\StoreHbA1cRequest;
use App\Http\Requests\UpdateHbA1cRequest;
use App\Lib\ToolTrait;
use Illuminate\Support\Facades\Auth;

class HbA1cController extends Controller
{
    use ToolTrait;
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
        if ($this->isPastDate($request->created_at)) {
            return redirect()->route('home')->withStatus("Ви не можете додавати показник в майбутньому :(, вибачте!");
        }
        HbA1c::insert([
            'user_id' => Auth::id(),
            'percentage' => $request->percentage,
            'note' => $request->input('note', ""),
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

    public function getLastDaysApi()
    {
        $hbLast = Auth::user()->hba1c()->orderBy('created_at','desc')->first();
        if (!$hbLast) {
            return response()->json([
                'error' => true,
                'errorMessage' => "No exists hba1c",
                'lastDate' => "",
                'level' => 0,
                'exceedingNormDiabet' => false,
                'exceedingIntervalDays' => false,
                'daysPassed' => 0
            ]);
        }
        return response()->json([
            'error' => false,
            'errorMessage' => "",
            'lastDate' => $hbLast->dateCreate('d.m.Y'),
            'level' => $hbLast->percentage,
            'exceedingNormDiabet' => $hbLast->exceedingNormDiabet(),
            'exceedingIntervalDays' => $hbLast->exceedingIntervalDays(),
            'daysPassed' => $hbLast->countLastFullDays()
        ]);
    }
}
