<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{

    protected $guarded = ['id'];

    use HasFactory;

    // Relationship to Quizze
    public function quizze(){
        return $this->belongsTo(Quizze::class);
    }

    // Relationship to Question
    public function question(){
        return $this->belongsTo(Question::class);
    }

    // Relationship to Question
    public function user(){
        return $this->belongsTo(User::class);
    }
}
