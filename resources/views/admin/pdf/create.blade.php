<!-- resources/views/admin/pdfs/create.blade.php -->

@extends('layouts.app_admin')

@section('content')
<div class="container">
    <h2>Upload New PDF</h2>
    <form action="{{ route('pdfs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="file">Upload PDF File</label>
            <input type="file" class="form-control" id="file" name="file" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
