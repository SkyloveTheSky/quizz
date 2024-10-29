@extends('layouts.app_admin')

@section('content')
    <div class="container">
        <h1>List of Listenings</h1>
        <a href="{{ route('listenings.create') }}" class="btn btn-primary">Add New Listening</a>
        <a href="{{ route('files.index') }}" class="btn btn-primary">Upload New Listening</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>File</th>
                    <th>Level</th>
                    <th>Translation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listenings as $listening)
                    <tr>
                        <td>{{ $listening->title }}</td>
                        <td>
                            <audio controls>
                                <source src="{{ Storage::url($listening->file_path) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </td>
                        <td>{{ $listening->level->name }}</td>
                        <td>{{ $listening->translation }}</td>
                        <td>
                            <a href="{{ route('listenings.edit', $listening->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('listenings.destroy', $listening->id) }}" method="POST" style="display:inline;">
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
