<!-- resources/views/user/pdfs/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Available PDFs</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>View PDF</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pdfs as $pdf)
                <tr>
                    <td>{{ $pdf->title }}</td>
                    <td>
                        <a href="{{ route('user.pdfs.show', ['hashed_user_id' => $hashed_user_id, 'pdf' => $pdf->id]) }}" target="_blank">
                            View PDF
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
