@extends('layouts.app_admin')

@section('content')
    <h1>Flashcards</h1>
    <div>
        <label for="level">Filter by Level:</label>
        <select name="level" id="level" onchange="location = this.value;">
            <option value="{{ route('flashcards.index') }}">All</option>
            @foreach ($levels as $level)
                <option value="{{ route('flashcards.level', ['level' => $level->id]) }}">{{ ucfirst($level->name) }}</option>
            @endforeach
        </select>
    </div>
    <a href="{{ route('flashcards.create') }}">Add Flashcard</a>
    <ul>
        @foreach ($flashcards as $flashcard)
        <li>
            <strong>Question:</strong> {{ $flashcard->question }}<br>
            <strong>Options:</strong><br>
            1. {{ $flashcard->option1 }}<br>
            2. {{ $flashcard->option2 }}<br>
            3. {{ $flashcard->option3 }}<br>
            4. {{ $flashcard->option4 }}<br>
            <strong>Correct Answer:</strong> {{ $flashcard[$flashcard->correct_answer] }}<br>
            <strong>Note:</strong> {{ $flashcard->note }}<br> <!-- Affichage de la note -->
            <strong>Level:</strong> {{ $flashcard->level ? ucfirst($flashcard->level->name) : 'None' }}<br>
            <a href="{{ route('flashcards.edit', $flashcard->id) }}">Edit</a>
            <form action="{{ route('flashcards.destroy', $flashcard->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
    </ul>
@endsection
