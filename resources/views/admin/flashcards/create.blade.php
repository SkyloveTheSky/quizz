@extends('layouts.app_admin')

@section('content')
    <h1>Add Flashcard</h1>
    <form action="{{ route('flashcards.store') }}" method="POST">
        @csrf
        <div>
            <label for="question">Question</label>
            <input type="text" name="question" id="question" required>
        </div>
        <div>
            <label for="option1">Option 1</label>
            <input type="text" name="option1" id="option1" required>
        </div>
        <div>
            <label for="option2">Option 2</label>
            <input type="text" name="option2" id="option2" required>
        </div>
        <div>
            <label for="option3">Option 3</label>
            <input type="text" name="option3" id="option3" required>
        </div>
        <div>
            <label for="option4">Option 4</label>
            <input type="text" name="option4" id="option4" required>
        </div>
        <div>
            <label for="correct_answer">Correct Answer</label>
            <select name="correct_answer" id="correct_answer" required>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
                <option value="option4">Option 4</option>
            </select>
        </div>
        <div>
            <label for="level_id">Level</label>
            <select name="level_id" id="level_id" required>
                @foreach ($levels as $level)
                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="note">Note</label>
            <input type="number" name="note" id="note" class="form-control" value="{{ old('note') }}" />
        </div>

        <button type="submit">Add Flashcard</button>
    </form>
@endsection
