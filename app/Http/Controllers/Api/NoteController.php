<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoteController extends Controller
{
    /**
     * GET /api/notes
     * supports ?q=search
     */
    public function index(Request $request)
    {
        $q = $request->query('q');

        $notes = Note::when($q, function ($query, $q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            })
            ->orderByDesc('created_at')
            ->get();

        return response()->json($notes);
    }

    /**
     * POST /api/notes
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
        ]);

        $note = Note::create($data);

        return response()->json($note, Response::HTTP_CREATED);
    }

    /**
     * GET /api/notes/{note}
     */
    public function show(Note $note)
    {
        return response()->json($note);
    }

    /**
     * PUT /api/notes/{note}
     */
    public function update(Request $request, Note $note)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
        ]);

        $note->update($data);

        return response()->json($note);
    }

    /**
     * DELETE /api/notes/{note}
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return response()->noContent();
    }
}
