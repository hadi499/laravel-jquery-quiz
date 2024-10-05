<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'topic',
        'number_of_questions',
        'time',
        'required_score_to_pass'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getQuestions()
    {
        return $this->questions()->take($this->number_of_questions)->get();
    }
}
