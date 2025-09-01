@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Edit Note</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('notes.update', $note) }}" method="POST">
            @csrf
            @method('PUT')

            @include('notes.partials._form', ['note' => $note])

            <div class="d-flex gap-2">
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('notes.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
