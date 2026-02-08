<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NotebookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $notebooks = Notebook::where("user_id", $user_id)->paginate(10);
        return view("notebooks.index", compact("notebooks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("notebooks.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:120"
        ]);

        $notebook = new Notebook([
            "name" => $request->name,
            "user_id" => Auth::id(),
            "uuid" => Str::uuid()
        ]);
        $notebook->save();

        return redirect()->route("notebooks.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(notebook $notebook)
    {
        if (Auth::id() != $notebook->user_id) {
            return abort(403);
        }
        return view("notebooks.show", ["notebook" => $notebook]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(notebook $notebook)
    {
        if (Auth::id() != $notebook->user_id) {
            return abort(403);
        }
        return view("notebooks.edit", ["notebook" => $notebook]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, notebook $notebook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(notebook $notebook)
    {
        //
    }
}
