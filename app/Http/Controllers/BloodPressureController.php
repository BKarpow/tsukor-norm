<?php

namespace App\Http\Controllers;

use App\Models\BloodPressure;
use App\Http\Requests\StoreBloodPressureRequest;
use App\Http\Requests\UpdateBloodPressureRequest;
use App\Http\Resources\BloodPressureResource;
use Illuminate\Support\Facades\Auth;

class BloodPressureController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BloodPressureResource::collection(
            Auth::user()
                ->bloodPressure()
                ->orderBy("created_at", "desc")
                ->paginate(25)
        );
    }

    public function getAllApi()
    {
        return BloodPressureResource::collection(
            Auth::user()
                ->bloodPressure()
                ->orderBy("created_at", "asc")
                ->get()
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBloodPressureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBloodPressureRequest $request)
    {
        $bp = new BloodPressure();
        $bp->user_id = Auth::id();
        $bp->sis = $request->sis;
        $bp->dis = $request->dis;
        $bp->pulse = $request->pulse;
        $bp->note = $request->note;
        $bp->save();
        return new BloodPressureResource($bp);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BloodPressure  $bloodPressure
     * @return \Illuminate\Http\Response
     */
    public function show(BloodPressure $bloodPressure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BloodPressure  $bloodPressure
     * @return \Illuminate\Http\Response
     */
    public function edit(BloodPressure $bloodPressure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBloodPressureRequest  $request
     * @param  \App\Models\BloodPressure  $bloodPressure
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBloodPressureRequest $request, BloodPressure $bloodPressure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BloodPressure  $bloodPressure
     * @return \Illuminate\Http\Response
     */
    public function destroy(BloodPressure $bloodPressure)
    {
        $this->authorize('delete', $bloodPressure);
        $bpId = (int)$bloodPressure->id;
        $bloodPressure->delete();
        return response()->json([
            'status' => true,
            'deletedId' => $bpId
        ]);
    }
}
