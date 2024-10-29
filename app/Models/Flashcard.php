<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    protected $fillable = [
        'question',
        'option1',
        'option2',
        'option3',
        'option4',
        'correct_answer',
        'level_id',
        'level',
        'note',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

     // Vérifier si la réponse donnée est correcte
     public function isCorrectAnswer($answer)
     {
         $correctAnswer = $this->correct_answer;

         // Si correct_answer est une option (option1, option2, etc.)
         if (in_array($correctAnswer, ['option1', 'option2', 'option3', 'option4'])) {
             $correctOption = $this->{$correctAnswer}; // Récupérer la valeur de l'option correcte
             return strtolower(trim($answer)) === strtolower(trim($correctOption));
         }

         // Si correct_answer est directement la réponse elle-même
         return strtolower(trim($answer)) === strtolower(trim($correctAnswer));
     }
}
