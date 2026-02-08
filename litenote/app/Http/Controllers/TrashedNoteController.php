<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashedNoteController extends Controller
{

    public function index()
    {
        $user_id = Auth::id();
//        $notes = Note::where("user_id", $user_id)->latest("updated_at")->paginate(5);
//        $notes = Auth::user()->notes()->get();
        $notes = Note::whereBelongsTo(Auth::user())->onlyTrashed()->latest("updated_at")->paginate(5);
        return view("notes.index", ["notes" => $notes]);
    }

    public function show(Note $note){
        if ($note->user_id != Auth::id()) {
            return abort(403);
        }
        return view("notes.show", ["note" => $note]);
    }

    public function update( Note $note){
        if ($note->user_id != Auth::id()) {
            return abort(403);
        }
        $note->restore();
        return to_route('notes.show', ["note" => $note])->with("success", "Note restored");
    }

    public function destroy(Note $note) {
        if ($note->user_id != Auth::id()) {
            return abort(403);
        }
        $note->forceDelete();
        return to_route("trashed.index")->with("success", "Note deleted");
    }
}
