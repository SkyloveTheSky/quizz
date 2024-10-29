@extends('layouts.app')

@section('content')
    <h1>Flashcards Quiz</h1>

    <div id="level-buttons">
        <a href="{{ route('user.flashcards.level', ['hashed_user_id' => $hashed_user_id, 'levelName' => 'débutant']) }}" class="btn btn-primary">Débutant</a>
        <a href="{{ route('user.flashcards.level', ['hashed_user_id' => $hashed_user_id, 'levelName' => 'intermédiaire']) }}" class="btn btn-secondary">Intermédiaire</a>
        <a href="{{ route('user.flashcards.level', ['hashed_user_id' => $hashed_user_id, 'levelName' => 'avancé']) }}" class="btn btn-success">Avancé</a>
    </div>
@endsection
