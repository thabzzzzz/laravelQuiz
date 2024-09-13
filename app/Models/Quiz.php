<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Define the relationship to HighScore
    public function highscores()
    {
        return $this->hasMany(HighScore::class);
    }
}
