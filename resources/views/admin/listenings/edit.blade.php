@extends('layouts.app_admin')

@section('content')
<div class="container">
    <h1>Edit Listening</h1>
    <form action="{{ route('listenings.update', $listening->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $listening->title }}" required>
        </div>
        <div class="form-group">
            <label for="file">Audio File (optional)</label>
            <input type="file" name="file" id="file" class="form-control" accept="audio/*">
        </div>
        <div class="form-group">
            <label for="existing_file">Or Choose Existing Audio File</label>
            <select class="form-control" id="existing_file" name="existing_file">
                <option value="">Select a file</option>
                @foreach($audioFiles as $file)
                    <option value="{{ $file }}">{{ basename($file) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="level_id">Level</label>
            <select name="level_id" id="level_id" class="form-control" required>
                @foreach($levels as $level)
                    <option value="{{ $level->id }}" {{ $listening->level_id == $level->id ? 'selected' : '' }}>
                        {{ $level->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="translation">Translation</label>
            <textarea class="form-control" id="translation" name="translation" rows="3">{{ $listening->translation }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Listening</button>
    </form>
</div>
@endsection
