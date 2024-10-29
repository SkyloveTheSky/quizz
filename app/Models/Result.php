<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'flashcard_id',
        'answer',
        'is_correct'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le modèle Flashcard
    public function flashcard()
    {
        return $this->belongsTo(Flashcard::class);
    }
}
