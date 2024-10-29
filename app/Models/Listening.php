<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Listening extends Model
{
    protected $fillable = ['title', 'file_path', 'level_id', 'translation'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
