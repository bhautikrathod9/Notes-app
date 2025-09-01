@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">New Note</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('notes.store') }}" method="POST">
            @csrf

            @include('notes.partials._form', ['note' => null])

            <div class="d-flex gap-2">
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('notes.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
