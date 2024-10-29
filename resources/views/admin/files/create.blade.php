<!-- resources/views/admin/files/create.blade.php -->

@extends('layouts.app_admin')

@section('content')
    <div class="container">
        <h1>Upload New File</h1>

        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="file">Audio File:</label>
                <input type="file" name="file" id="file" class="form-control" accept="audio/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
@endsection
