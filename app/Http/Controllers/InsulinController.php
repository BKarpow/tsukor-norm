<?php

namespace App\Http\Controllers;

use App\Models\Insulin;
use App\Http\Requests\StoreInsulinRequest;
use App\Http\Requests\UpdateInsulinRequest;
use Illuminate\Support\Facades\Auth;

class InsulinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('insulin.index', [
            'insulins' => Auth::user()->insulin()->orderBy('name', 'asc')->paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('insulin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInsulinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInsulinRequest $request)
    {
        $insulin = new Insulin();
        $insulin->user_id = Auth::id();
        $insulin->name = $request->name;
        $insulin->type = $request->type;
        $insulin->note = $request->note;
        $insulin->save();
        return redirect()->route('insulin.index')->withStatus('Препарат інсуліну додано!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Insulin  $insulin
     * @return \Illuminate\Http\Response
     */
    public function show(Insulin $insulin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Insulin  $insulin
     * @return \Illuminate\Http\Response
     */
    public function edit(Insulin $insulin)
    {
        $this->authorize('update', $insulin);
        return view('insulin.update', [
            'insulin' => $insulin
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInsulinRequest  $request
     * @param  \App\Models\Insulin  $insulin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInsulinRequest $request, Insulin $insulin)
    {
        $this->authorize('update', $insulin);
        $insulin->name = $request->name;
        $insulin->type = $request->type;
        $insulin->note = $request->note;
        $insulin->save();
        return redirect()->route('insulin.index')->withStatus('Препарат інсуліну додано!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Insulin  $insulin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insulin $insulin)
    {
        $this->authorize('delete', $insulin);
        $iid = $insulin->id;
        $insulin->delete();
        return response()->json([
            'status' => true,
            'deletedId' => $iid
        ]);
    }
}
