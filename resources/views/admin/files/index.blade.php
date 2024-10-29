<!-- resources/views/admin/files/index.blade.php -->

@extends('layouts.app_admin')

@section('content')
    <div class="container">
        <h1>Manage Files</h1>

        <a href="{{ route('files.create') }}" class="btn btn-primary">Upload New File</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>File</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $file)
                    <tr>
                        <td>{{ $file->title }}</td>
                        <td>
                            <audio controls>
                                <source src="{{ asset('storage/' . $file->file_path) }}" type="audio/{{ $file->file_type }}">
                                Your browser does not support the audio element.
                            </audio>
                        </td>
                        <td>
                            <form action="{{ route('files.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
