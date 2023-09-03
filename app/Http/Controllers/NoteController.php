<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('note.index', [
            'notes' => Auth::user()->notes()
                        ->orderBy('created_at', 'DESC')
                        ->wherePublic(true)
                        ->paginate(24),
        ]);
    }

     /**
     * Для сторінки архіву.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexArhive()
    {
        return view('note.arhive', [
            'notes' => Auth::user()->notes()
                        ->orderBy('created_at', 'DESC')
                        ->wherePublic(false)
                        ->paginate(24),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoteRequest $request)
    {
        $showMain = $request->showMain == 'on' ? true: false;
        $note = new Note();
        $note->user_id = Auth::id();
        $note->title = $request->title ?? '';
        $note->text = $request->text;
        $note->show_main = $showMain;
        $note->save();
        return redirect()->route('note.index')
                        ->withStatus('Нотатка додана успішно!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        $this->authorize('view', $note);
        if (!(bool)$note->public) {
            abort(404);
        }
        return view('note.show', [
            'note' => $note,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        $this->authorize('update', $note);
        return view('note.update', [
            'note' => $note,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNoteRequest  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $this->authorize('update', $note);
        $showMain = $request->showMain == 'on' ? true: false;
        $public = $request->public == 'on' ? true: false;
        $note->title = $request->title ?? '';
        $note->text = $request->text;
        $note->show_main = $showMain;
        $note->public = $public;
        $note->save();
        return redirect()->route('note.index')
                        ->withStatus('Нотатка оновлена успішно!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);
        $ntId = $note->id;
        $note->delete();
        return response()->json([
            'status' => true,
            'deletedId' => $ntId
        ]);
    }

    /**
     * Переміщує нотатку до архіву.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function moveArhive(Note $note)
    {
        $this->authorize('delete', $note);
        $note->public = false;
        $note->save();
        return response()->json([
            'status' => true,
            'deletedId' => $note->id
        ]);
    }
}
