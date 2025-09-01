@php
    $isEdit = isset($note) && $note;
@endphp

<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input id="title" name="title" type="text" class="form-control"
           value="{{ old('title', $isEdit ? $note->title : '') }}" required maxlength="255">
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea id="description" name="description" class="form-control" rows="6">{{ old('description', $isEdit ? $note->description : '') }}</textarea>
</div>
