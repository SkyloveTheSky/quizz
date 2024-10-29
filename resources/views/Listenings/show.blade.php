<!-- resources/views/student/listenings/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $listening->title }}</h1>
    <audio controls>
        <source src="{{ Storage::url($listening->file_path) }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <p>{{ $listening->translation }}</p>
</div>
@endsection
