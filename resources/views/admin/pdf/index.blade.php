<!-- resources/views/admin/pdfs/index.blade.php -->

@extends('layouts.app_admin')

@section('content')
<div class="container">
    <h1>List of PDFs</h1>
    <a href="{{ route('pdfs.create') }}" class="btn btn-primary">Upload New PDF</a>

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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pdfs as $pdf)
                <tr>
                    <td>{{ $pdf->title }}</td>
                    <td><a href="{{ Storage::url($pdf->file_path) }}" target="_blank">View PDF</a></td>
                    <td>
                        <a href="{{ route('pdfs.edit', $pdf->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('pdfs.destroy', $pdf->id) }}" method="POST" style="display:inline;">
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
