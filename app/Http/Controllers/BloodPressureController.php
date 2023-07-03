<?php

namespace App\Http\Controllers;

use App\Models\BloodPressure;
use App\Http\Requests\StoreBloodPressureRequest;
use App\Http\Requests\UpdateBloodPressureRequest;
use App\Http\Resources\BloodPressureResource;
use App\Lib\HistoryServicesTrait;
use App\Models\UserWriteHistory;
use Illuminate\Support\Facades\Auth;

class BloodPressureController extends Controller
{
    use HistoryServicesTrait;

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
        return view('bloodPressure.index', [
            'bps' => Auth::user()
                        ->bloodPressure()
                        ->orderBy("created_at", "desc")
                        ->paginate(25)
        ]);
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
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
        return view('bloodPressure.create');
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
        $bp->note = $request->input('note', "Вимір АТ");
        $bp->created_at = $request->createdAt;
        $bp->save();
        UserWriteHistory::insert([
            'user_id' => Auth::id(),
            'write_id' => $bp->id,
            'type' => UserWriteHistory::TYPE_BLOOD_PRESSURE,
            'note' => 'Controller store',
            'created_at' => $request->createdAt,
            'updated_at' => now(),
        ]);
        return response()->json([
            'storeStatus' => true
        ]);
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
        $this->authorize('delete', $bloodPressure);
        return view('bloodPressure.update', [
            'bp' => $bloodPressure
        ]);
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
        $this->authorize('delete', $bloodPressure);
        $bloodPressure->user_id = Auth::id();
        $bloodPressure->sis = $request->sis;
        $bloodPressure->dis = $request->dis;
        $bloodPressure->pulse = $request->pulse;
        $bloodPressure->note = $request->note;
        $bloodPressure->created_at = $request->created_at;
        $bloodPressure->save();
        return redirect()->route('home')->withStatus('Оновлено показник артеріального тиску');
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
        $this->deleteUserHistryFromWriteId(UserWriteHistory::TYPE_BLOOD_PRESSURE, $bpId);
        $bloodPressure->delete();
        return response()->json([
            'status' => true,
            'deletedId' => $bpId
        ]);
    }
}
