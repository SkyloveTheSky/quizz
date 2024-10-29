<?php
namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LevelController extends Controller
{
    public function indexByLevel($hashed_user_id, $levelName)
    {
        Log::info("Début de la méthode indexByLevel", ['hashed_user_id' => $hashed_user_id, 'levelName' => $levelName]);

        $level = Level::where('name', $levelName)->first();
        Log::info("Niveau récupéré", ['level' => $level]);

        if (!$level) {
            Log::error("Niveau non trouvé", ['levelName' => $levelName]);
            return redirect()->route('user.home', ['hashed_user_id' => $hashed_user_id])
                             ->with('error', 'Niveau non trouvé.');
        }

        $flashcards = Flashcard::where('level_id', $level->id)->get();
        Log::info("Flashcards récupérées", ['flashcards' => $flashcards]);

        if ($flashcards->isEmpty()) {
            Log::info("Aucune flashcard disponible pour ce niveau", ['level_id' => $level->id]);
            return view('flashcards_quizz.no_flashcards', compact('hashed_user_id', 'levelName'))
                   ->with('message', 'No flashcards available for this level.');
        }

        $answeredFlashcards = collect(session()->get("answered_flashcards_{$hashed_user_id}_{$levelName}", []));
        Log::info("Flashcards déjà répondues", ['answeredFlashcards' => $answeredFlashcards]);

        $remainingFlashcards = $flashcards->whereNotIn('id', $answeredFlashcards->toArray());
        Log::info("Flashcards restantes", ['remainingFlashcards' => $remainingFlashcards]);

        if ($remainingFlashcards->isEmpty()) {
            $totalNotes = session()->get("total_notes_{$hashed_user_id}_{$levelName}", 0);
            $errors = session()->get("errors_{$hashed_user_id}_{$levelName}", []);
            Log::info("Toutes les questions ont été répondues", ['totalNotes' => $totalNotes, 'errors' => $errors]);

            session()->forget("answered_flashcards_{$hashed_user_id}_{$levelName}");
            session()->forget("total_notes_{$hashed_user_id}_{$levelName}");
            session()->forget("errors_{$hashed_user_id}_{$levelName}");

            return view('flashcards_quizz.no_flashcards', compact('hashed_user_id', 'levelName', 'totalNotes', 'errors'))
                   ->with('message', 'All questions have been answered.');
        }

        $currentFlashcard = $remainingFlashcards->random();
        Log::info("Flashcard actuelle sélectionnée", ['currentFlashcard' => $currentFlashcard]);
        return view('flashcards_quizz.flashcards', compact('currentFlashcard', 'hashed_user_id', 'levelName'));
    }

    public function checkAnswer(Request $request, $hashed_user_id, Flashcard $flashcard)
    {
        Log::info("Début de la méthode checkAnswer", ['hashed_user_id' => $hashed_user_id, 'flashcard_id' => $flashcard->id]);

        $request->validate(['answer' => 'required']);

        $userAnswer = trim($request->input('answer'));
        Log::info("Réponse utilisateur", ['userAnswer' => $userAnswer]);

        $isCorrect = $flashcard->isCorrectAnswer($userAnswer);
        Log::info("Réponse correcte ?", ['isCorrect' => $isCorrect]);

        $levelName = $flashcard->level->name;
        $answeredFlashcardsKey = "answered_flashcards_{$hashed_user_id}_{$levelName}";
        $totalNotesKey = "total_notes_{$hashed_user_id}_{$levelName}";
        $errorsKey = "errors_{$hashed_user_id}_{$levelName}";

        $answeredFlashcards = collect(session()->get($answeredFlashcardsKey, []));
        $answeredFlashcards->push($flashcard->id);
        session()->put($answeredFlashcardsKey, $answeredFlashcards->toArray());
        Log::info("Flashcards répondues mises à jour", ['answeredFlashcards' => $answeredFlashcards]);

        if ($isCorrect) {
            session()->flash('correct_answer', true);
            $note = $flashcard->note;
            $totalNotes = session()->get($totalNotesKey, 0) + $note;
            session()->put($totalNotesKey, $totalNotes);
            session()->flash('note', $note); // Stocker la note obtenue dans la session
            Log::info("Réponse correcte, note ajoutée", ['note' => $note, 'totalNotes' => $totalNotes]);
        } else {
            session()->flash('correct_answer', false);
            $errors = session()->get($errorsKey, []);
            $errors[] = ['question' => $flashcard->question, 'correct_answer' => $flashcard->correct_answer, 'user_answer' => $userAnswer];
            session()->put($errorsKey, $errors);
            session()->flash('note', 0); // Stocker une note de 0 pour une réponse incorrecte
            Log::info("Réponse incorrecte, erreur ajoutée", ['errors' => $errors]);
        }

        return redirect()->route('user.flashcards.result', [
            'hashed_user_id' => $hashed_user_id,
            'flashcard' => $flashcard->id,
            'levelName' => $levelName
        ]);
    }

    public function nextFlashcard($hashed_user_id, $levelName, $flashcard_id)
{
    Log::info("Début de la méthode nextFlashcard", ['hashed_user_id' => $hashed_user_id, 'flashcard_id' => $flashcard_id]);

    $flashcard = Flashcard::find($flashcard_id);

    if (!$flashcard) {
        Log::error("Flashcard non trouvée", ['flashcard_id' => $flashcard_id]);
        return redirect()->route('user.home', ['hashed_user_id' => $hashed_user_id])
                         ->with('error', 'Flashcard non trouvée.');
    }

    $level = $flashcard->level;

    if (!$level) {
        Log::error("Niveau non trouvé pour la flashcard", ['flashcard_id' => $flashcard_id]);
        return redirect()->route('user.home', ['hashed_user_id' => $hashed_user_id])
                         ->with('error', 'Niveau non trouvé.');
    }

    $flashcards = Flashcard::where('level_id', $level->id)->get();
    Log::info("Flashcards pour le niveau", ['flashcards' => $flashcards]);

    $answeredFlashcards = collect(session()->get("answered_flashcards_{$hashed_user_id}_{$levelName}", []));
    $remainingFlashcards = $flashcards->whereNotIn('id', $answeredFlashcards->toArray());

    if ($remainingFlashcards->isEmpty()) {
        Log::info("Toutes les questions ont été répondues", ['totalNotes' => session()->get("total_notes_{$hashed_user_id}_{$levelName}", 0)]);
        return redirect()->route('user.flashcards.level', ['hashed_user_id' => $hashed_user_id, 'levelName' => $levelName])
                         ->with('message', 'All questions have been answered.');
    }

    $currentFlashcard = $remainingFlashcards->random();
    Log::info("Flashcard suivante sélectionnée", ['currentFlashcard' => $currentFlashcard]);

    return view('flashcards_quizz.flashcards', compact('currentFlashcard', 'hashed_user_id', 'levelName'));
}


    public function showResult($hashed_user_id, Flashcard $flashcard, $levelName)
    {
        Log::info("Début de la méthode showResult", ['hashed_user_id' => $hashed_user_id, 'flashcard_id' => $flashcard->id, 'levelName' => $levelName]);

        return view('flashcards_quizz.result', compact('hashed_user_id', 'flashcard', 'levelName'));
    }
}
