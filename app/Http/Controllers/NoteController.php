<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of notes (with optional search).
     */
    public function index(Request $request)
    {
        $q = $request->query('q');

        $notes = Note::when($q, function ($query, $q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('notes.index', compact('notes', 'q'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a new note.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
        ]);

        Note::create($data);

        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    /**
     * Display a single note.
     */
    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    /**
     * Show edit form.
     */
    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the note.
     */
    public function update(Request $request, Note $note)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
        ]);

        $note->update($data);

        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
    }

    /**
     * Delete the note.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Note deleted.');
    }
}
