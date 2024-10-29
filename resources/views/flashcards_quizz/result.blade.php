@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('correct_answer'))
            <div class="alert alert-success">
                Correct! Note obtenue : {{ session('note') }}
            </div>
        @else
            <div class="alert alert-danger">
                Incorrect! La bonne réponse est : {{ $flashcard->correct_answer }}
            </div>
        @endif
        <a href="{{ route('user.flashcards.next', ['hashed_user_id' => $hashed_user_id, 'flashcard_id' => $flashcard->id, 'levelName' => $levelName]) }}" class="btn btn-primary">Next Question</a>
    </div>
@endsection
