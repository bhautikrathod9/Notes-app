@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Notes</h1>
    <a href="{{ route('notes.create') }}" class="btn btn-primary">+ New Note</a>
</div>

<form method="GET" action="{{ route('notes.index') }}" class="row g-2 mb-3">
    <div class="col-md-8">
        <input type="text" name="q" value="{{ old('q', $q ?? '') }}" class="form-control" placeholder="Search by title or description">
    </div>
    <div class="col-md-4">
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary">Search</button>
            <a href="{{ route('notes.index') }}" class="btn btn-outline-light btn-secondary">Reset</a>
        </div>
    </div>
</form>

@if ($notes->count())
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notes as $note)
                    <tr>
                        <td>{{ $note->id }}</td>
                        <td><a href="{{ route('notes.show', $note) }}" class="text-decoration-none">{{ $note->title }}</a></td>
                        <td style="max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $note->description }}
                        </td>
                        <td>{{ $note->created_at->format('Y-m-d H:i') }}</td>
                        <td class="text-end">
                            <a href="{{ route('notes.show', $note) }}" class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('notes.edit', $note) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                            <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this note?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $notes->links() }}
@else
    <div class="alert alert-light">No notes yet. <a href="{{ route('notes.create') }}">Create one</a>.</div>
@endif
@endsection
