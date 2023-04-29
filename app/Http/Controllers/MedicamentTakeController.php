<?php

namespace App\Http\Controllers;

use App\Models\MedicamentTake;
use App\Http\Requests\StoreMedicamentTakeRequest;
use App\Http\Requests\UpdateMedicamentTakeRequest;
use Illuminate\Support\Facades\Auth;

class MedicamentTakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('medicamentTake.index', [
            'meds' => Auth::user()->medTake()
            ->orderBy('created_at', 'desc')
            ->paginate(25),
        ]);
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
        return view('medicamentTake.create', [
            'medicaments' => Auth::user()->medicaments()
            ->orderBy('name', 'asc')
            ->whereActive(true)
            ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMedicamentTakeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMedicamentTakeRequest $request)
    {
        $m = new MedicamentTake();
        $m->user_id = Auth::id();
        $m->med_id = $request->med_id;
        $m->dose = $request->dose;
        $m->note = $request->input('note', "");
        $m->created_at = $request->created_at;
        $m->save();
        return redirect()
            ->route('home')
            ->withStatus('Прийом ліків додано.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicamentTake  $medicamentTake
     * @return \Illuminate\Http\Response
     */
    public function show(MedicamentTake $medicamentTake)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicamentTake  $medicamentTake
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicamentTake $medicamentTake)
    {
        $this->authorize('update', $medicamentTake);
        return view('medicamentTake.update', [
            'medicament' => $medicamentTake,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMedicamentTakeRequest  $request
     * @param  \App\Models\MedicamentTake  $medicamentTake
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMedicamentTakeRequest $request, MedicamentTake $medicamentTake)
    {
        $this->authorize('update', $medicamentTake);
        $medicamentTake->dose = $request->dose;
        $medicamentTake->note = $request->note;
        $medicamentTake->created_at = $request->created_at;
        $medicamentTake->save();
        return redirect()
            ->route('home')
            ->withStatus('Прийом ліків оновлено.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicamentTake  $medicamentTake
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicamentTake $medicamentTake)
    {
        $this->authorize('update', $medicamentTake);
        $id = $medicamentTake->id;
        $medicamentTake->delete();
        return response()->json([
            'status' => true,
            'deletedId' => $id
        ]);

    }
}
