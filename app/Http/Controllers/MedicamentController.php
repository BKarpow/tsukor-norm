<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use App\Http\Requests\StoreMedicamentRequest;
use App\Http\Requests\UpdateMedicamentRequest;
use App\Http\Resources\MedicamentResource;
use Faker\Provider\Medical;
use Illuminate\Support\Facades\Auth;

class MedicamentController extends Controller
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
        return view('medicament.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMedicamentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMedicamentRequest $request)
    {
        $med = new Medicament();
        $med->user_id = Auth::id();
        $med->name = $request->name;
        $med->dose = $request->dose;
        // $med->url_shop = $request->url_shop;
        $med->number = (int)$request->number;
        $med->sugar_lower = (bool)$request->sugar_lower;
        $med->active = (bool)$request->active;
        $med->note = $request->input('note', "");
        $med->save();
        return redirect()->route('home')->withStatus("Ліки {$med->name} успішно збережені");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function show(Medicament $medicament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicament $medicament)
    {
        $this->authorize('update', $medicament);
        return view('medicament.update', [
            'med' => $medicament
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMedicamentRequest  $request
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMedicamentRequest $request, Medicament $medicament)
    {
        $this->authorize('update', $medicament);
        $medicament->name = $request->name;
        $medicament->dose = $request->dose;
        // $medicament->url_shop = $request->url_shop;
        $medicament->number = (int)$request->number;
        $medicament->sugar_lower = (bool)$request->sugar_lower;
        $medicament->active = (bool)$request->active;
        $medicament->note = $request->note;
        $medicament->save();
        return redirect()->route('home')->withStatus("Ліки {$medicament->name} успішно збережені");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicament $medicament)
    {
        $this->authorize('update', $medicament);
        $n = $medicament->name;
        $medicament->delete();
        return redirect()->route('home')->withStatus("Ліки {$n} видалено!");
    }

    public function triggerActive(Medicament $medicament)
    {
        $this->authorize('update', $medicament);
        $medicament->active = !(bool)$medicament->active;
        $medicament->save();
        return response()->json([
            'medId' => (int)$medicament->id,
            'active' => (bool)$medicament->active
        ]);
    }

    public function getActiveMedSugar()
    {
        return MedicamentResource::collection(
            Auth::user()
                ->medicaments()
                ->whereActive(true)
                ->whereSugarLower(true)
                ->orderBy('name', 'asc')
                ->get()
        );
    }
}
