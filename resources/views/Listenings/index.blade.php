<!-- resources/views/student/listenings/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Écoutes au Niveau {{ ucfirst($levelName) }}</h1>

    @foreach ($listenings as $listening)
        <div>
            <h2>{{ $listening->title }}</h2>
            <audio controls>
                <source src="{{ Storage::url($listening->file_path) }}" type="audio/mpeg">
                Votre navigateur ne supporte pas l'élément audio.
            </audio>
            <a href="{{ route('user.listenings.show', ['hashed_user_id' => $hashed_user_id, 'listening' => $listening->id]) }}" class="btn btn-info">Voir les détails</a>
        </div>
    @endforeach
</div>
@endsection
