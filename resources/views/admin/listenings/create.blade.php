@extends('layouts.app_admin')

@section('content')
<div class="container">
    <h2>Create New Listening</h2>
    <form action="{{ route('listenings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="level_id">Level</label>
            <select class="form-control" id="level_id" name="level_id" required>
                @foreach($levels as $level)
                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="new_file">Upload New Audio File</label>
            <input type="file" class="form-control" id="new_file" name="new_file">
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
            <label for="translation">Translation</label>
            <textarea class="form-control" id="translation" name="translation" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Listening</button>
    </form>
</div>
@endsection
