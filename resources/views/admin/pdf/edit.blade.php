<!-- resources/views/admin/pdfs/edit.blade.php -->

@extends('layouts.app_admin')

@section('content')
<div class="container">
    <h2>Edit PDF</h2>
    <form action="{{ route('pdfs.update', $pdf->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $pdf->title }}" required>
        </div>
        <div class="form-group">
            <label for="file">Upload New PDF File (optional)</label>
            <input type="file" class="form-control" id="file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
