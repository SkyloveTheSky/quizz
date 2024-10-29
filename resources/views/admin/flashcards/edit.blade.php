@extends('layouts.app_admin')

@section('content')
    <h1>Edit Flashcard</h1>
    <form action="{{ route('flashcards.update', $flashcard->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="question">Question</label>
            <input type="text" name="question" id="question" value="{{ $flashcard->question }}" required>
        </div>
        <div>
            <label for="option1">Option 1</label>
            <input type="text" name="option1" id="option1" value="{{ $flashcard->option1 }}" required>
        </div>
        <div>
            <label for="option2">Option 2</label>
            <input type="text" name="option2" id="option2" value="{{ $flashcard->option2 }}" required>
        </div>
        <div>
            <label for="option3">Option 3</label>
            <input type="text" name="option3" id="option3" value="{{ $flashcard->option3 }}" required>
        </div>
        <div>
            <label for="option4">Option 4</label>
            <input type="text" name="option4" id="option4" value="{{ $flashcard->option4 }}" required>
        </div>
        <div>
            <label for="correct_answer">Correct Answer</label>
            <select name="correct_answer" id="correct_answer" required>
                <option value="option1" {{ $flashcard->correct_answer == 'option1' ? 'selected' : '' }}>Option 1</option>
                <option value="option2" {{ $flashcard->correct_answer == 'option2' ? 'selected' : '' }}>Option 2</option>
                <option value="option3" {{ $flashcard->correct_answer == 'option3' ? 'selected' : '' }}>Option 3</option>
                <option value="option4" {{ $flashcard->correct_answer == 'option4' ? 'selected' : '' }}>Option 4</option>
            </select>
        </div>
        <div>
            <label for="level_id">Level</label>
            <select name="level_id" id="level_id" required>
                @foreach ($levels as $level)
                    <option value="{{ $level->id }}" {{ $level->id == $flashcard->level_id ? 'selected' : '' }}>{{ $level->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="note">Note</label>
            <input type="number" name="note" id="note" class="form-control" value="{{ old('note', $flashcard->note) }}" />
        </div>
        <button type="submit">Update Flashcard</button>
    </form>
@endsection
