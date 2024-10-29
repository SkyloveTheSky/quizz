<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\Level;
use Illuminate\Http\Request;

class FlashcardController extends Controller
{
    protected $levels = ['débutant', 'intermédiaire', 'avancé'];

    public function index()
    {
        $flashcards = Flashcard::with('level')->get();
        $levels = Level::all();
        return view('admin.flashcards.index', compact('flashcards', 'levels'));
    }

    public function create()
{
    $levels = Level::all();
    return view('admin.flashcards.create', compact('levels'));
}

    public function store(Request $request)
{
    $request->validate([
        'question' => 'required|string|max:255',
        'option1' => 'required|string|max:255',
        'option2' => 'required|string|max:255',
        'option3' => 'required|string|max:255',
        'option4' => 'required|string|max:255',
        'correct_answer' => 'required|string|in:option1,option2,option3,option4',
        'level_id' => 'required|exists:levels,id',
        'note' => 'required|integer',
    ]);

    $flashcard = new Flashcard($request->all());
    $flashcard->correct_answer = $request->input($request->correct_answer); // Stocke la valeur correcte
    $flashcard->save();

    return redirect()->route('flashcards.index')->with('success', 'Flashcard created successfully.');
}
    public function edit(Flashcard $flashcard)
    {
        $levels = Level::all();
        $flashcard->load('level');
        return view('admin.flashcards.edit', compact('flashcard', 'levels'));
    }

    public function update(Request $request, Flashcard $flashcard)
{
    $request->validate([
        'question' => 'required|string|max:255',
        'option1' => 'required|string|max:255',
        'option2' => 'required|string|max:255',
        'option3' => 'required|string|max:255',
        'option4' => 'required|string|max:255',
        'correct_answer' => 'required|string|in:option1,option2,option3,option4',
        'level_id' => 'required|exists:levels,id',
    ]);

    $flashcard->update($request->all());
    $flashcard->correct_answer = $request->input($request->correct_answer); // Met à jour la valeur correcte
    $flashcard->save();

    return redirect()->route('flashcards.index')->with('success', 'Flashcard updated successfully.');
}


    public function destroy(Flashcard $flashcard)
    {
        $flashcard->delete();

        return redirect()->route('flashcards.index')->with('success', 'Flashcard deleted successfully.');
    }

    public function indexByLevel($level)
    {
        $flashcards = Flashcard::where('level_id', $level)->get();
        $levels = Level::all();
        return view('admin.flashcards.index', compact('flashcards', 'levels'));
    }
}
