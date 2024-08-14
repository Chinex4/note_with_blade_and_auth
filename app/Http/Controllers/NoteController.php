<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(request()->user()->id);
        $notes = Note::where('user_id', request()->user()->id )
                ->with('user')
                ->latest()
                ->paginate();
        // dd($notes['user_id']);
        return view('note.index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputData = $request->validate([
            'notes' => ['required', 'string', 'min:10', 'max:2500'],
            'image' => ['nullable', 'image', 'max:2048', 'mimes:png,jpg,gif'],
        ]);
        // dd($request->user()->id);

        if ($request->hasFile('image')) {
            # code...
            $inputData['image'] = $request->file('image')->store('images', 'public');
        } else{
            $inputData['image'] = 'default-image.jpg';
        }

        $inputData['user_id'] = $request->user()->id;

        $note = Note::create($inputData);

        return to_route('note.show', $note)->with('message', 'Note was created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if($note->user_id != request()->user()->id){
            abort(404);
        }
        return view('note.show', ['note'=>$note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('note.edit', ['note'=>$note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $inputData = $request->validate([
            'notes' => ['required', 'string', 'min:10', 'max:2500'],
            'image' => ['nullable', 'image', 'max:2048', 'mimes:png,jpg,gif'],
        ]);

        if ($request->hasFile('image')) {
            # code...
            $inputData['image'] = $request->file('image')->store('images', 'public');
        } else{
            $inputData['image'] = 'default-image.jpg';
        }

        $note->update($inputData);

        return to_route('note.show', $note)->with('message', 'Note was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return to_route('note.index')->with('message', 'Note was deleted successfully');
    }
}
