@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Flashcard Quiz - Niveau: {{ $levelName }}</h2>
        <form action="{{ route('user.flashcards.check_answer', ['hashed_user_id' => $hashed_user_id, 'flashcard' => $currentFlashcard->id]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="question">{{ $currentFlashcard->question }}</label>
                <div>
                    <input type="radio" name="answer" value="{{ $currentFlashcard->option1 }}" required> {{ $currentFlashcard->option1 }}<br>
                    <input type="radio" name="answer" value="{{ $currentFlashcard->option2 }}" required> {{ $currentFlashcard->option2 }}<br>
                    <input type="radio" name="answer" value="{{ $currentFlashcard->option3 }}" required> {{ $currentFlashcard->option3 }}<br>
                    <input type="radio" name="answer" value="{{ $currentFlashcard->option4 }}" required> {{ $currentFlashcard->option4 }}<br>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
