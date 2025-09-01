@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">{{ $note->title }}</h1>
    <div>
        <a href="{{ route('notes.edit', $note) }}" class="btn btn-outline-primary">Edit</a>
        <a href="{{ route('notes.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <p class="text-muted mb-2">Created: {{ $note->created_at->format('Y-m-d H:i') }}</p>
        <p style="white-space: pre-wrap;">{{ $note->description }}</p>
    </div>
</div>
@endsection
