<?php

namespace App\Http\Controllers;

use App\Models\InsulinTake;
use App\Http\Requests\StoreInsulinTakeRequest;
use App\Http\Requests\UpdateInsulinTakeRequest;
use App\Models\Insulin;
use App\Models\UserWriteHistory;
use Illuminate\Support\Facades\Auth;

class InsulinTakeController extends Controller
{
    /**
     * Checks whether the insulin added by the user is in their list of insulin products.
     */
    private function isThisUserInsulin($request)
    {
        $ins = Auth::user()->insulin()->select('id')->get();
        $thisUser = false;
        foreach($ins as $iid) {
            if ($iid->id == $request->insulin_id) {
                $thisUser = true;
            }
        }
        if (!$thisUser) {
            abort(418);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('insulinTake.index', [
            'insulins' => Auth::user()->insulinLog()->orderBy('created_at', 'desc')->paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('insulinTake.create', [
            'insulins' => Auth::user()->insulin()->orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInsulinTakeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInsulinTakeRequest $request)
    {
        $this->isThisUserInsulin($request);
        $it = new InsulinTake();
        $it->user_id = Auth::id();
        $it->insulin_id = $request->insulin_id;
        $it->insulin_dose = $request->insulin_dose;
        $it->note = $request->input('note', "");
        $it->created_at = $request->created_at;
        $it->save();
        UserWriteHistory::insert([
            'user_id' => Auth::id(),
            'write_id' => $it->id,
            'type' => UserWriteHistory::TYPE_INSULIN_TAKE,
            'note' => 'Controller store',
            'created_at' => $request->created_at,
            'updated_at' => now(),
        ]);
        return redirect()->route('insulinLog.index')->withStatus('Прийом інсуліну записано');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InsulinTake  $insulinTake
     * @return \Illuminate\Http\Response
     */
    public function show(InsulinTake $insulinTake)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InsulinTake  $insulinTake
     * @return \Illuminate\Http\Response
     */
    public function edit(InsulinTake $insulinTake)
    {
        return view('insulinTake.update', [
            'il' => $insulinTake,
            'insulins' => Auth::user()->insulin()->orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInsulinTakeRequest  $request
     * @param  \App\Models\InsulinTake  $insulinTake
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInsulinTakeRequest $request, InsulinTake $insulinTake)
    {
        $this->authorize('update', $insulinTake);
        $this->isThisUserInsulin($request);
        $insulinTake->insulin_id = $request->insulin_id;
        $insulinTake->insulin_dose = $request->insulin_dose;
        $insulinTake->note = $request->note;
        $insulinTake->created_at = $request->created_at;
        $insulinTake->save();
        return redirect()->route('insulinLog.index')->withStatus('Прийом інсуліну оновлено.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InsulinTake  $insulinTake
     * @return \Illuminate\Http\Response
     */
    public function destroy(InsulinTake $insulinTake)
    {
        $this->authorize('update', $insulinTake);
        $id = $insulinTake->id;
        $insulinTake->delete();
        return response()->json([
            'status' => true,
            'deletedId' => $id
        ]);

    }
}
