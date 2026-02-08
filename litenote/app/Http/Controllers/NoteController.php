<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
//        $notes = Note::where("user_id", $user_id)->latest("updated_at")->paginate(5);
//        $notes = Auth::user()->notes()->get();
        $notes = Note::whereBelongsTo(Auth::user())->latest("updated_at")->paginate(5);
        return view("notes.index", ["notes" => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notebooks = $this->getUserNotebooks();
        return view("notes.create", ["notebooks" => $notebooks]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:120",
            "text" => "required|string"
        ]);

//        $note = new Note([
//                "user_id" => Auth::id(),
//                "uuid" => Str::uuid(),
//                "title" => $request->title,
//                "text" => $request->text,
//                "notebook_id" => $request->notebook_id
//            ]
//        );

        $note = Auth::user()->notes()->create([
            "uuid" => Str::uuid(),
            "title" => $request->title,
            "text" => $request->text,
            "notebook_id" => $request->notebook_id
        ]);

        return redirect()->route("notes.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if ($note->user_id != Auth::id()) {
            return abort(403);
        }
        return view("notes.show", ["note" => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if ($note->user_id != Auth::id()) {
            return abort(403);
        }
        $notebooks = $this->getUserNotebooks();
        return view("notes.edit", ["note" => $note, 'notebooks' => $notebooks]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $request->validate([
            "title" => "required|string|max:120",
            "text" => "required|string"
        ]);

        if ($note->user_id != Auth::id()) {
            return abort(403);
        }

        $note->update([
            "title" => $request->title,
            "text" => $request->text,
            "notebook_id" => $request->notebook_id
        ]);

        $note->save();

        return redirect()->route("notes.show", ["note" => $note])->with("success", "Note Edited Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if ($note->user_id != Auth::id()) {
            return abort(403);
        }

        $note->delete();

        return to_route("notes.index")->with("success", "Note Deleted Successfully");
    }

    private function getUserNotebooks()
    {
        if (!Auth::check()) {
            return abort(403);
        }
        return Notebook::where("user_id", Auth::id())->get();
    }
}
