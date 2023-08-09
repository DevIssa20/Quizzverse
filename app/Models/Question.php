<?php

namespace App\Models;
use Illuminate\Support\ServiceProvider;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    // Relationship to Quizze
    public function quizze(){
        return $this->belongsTo(Quizze::class);
    }

    // Relationship with Responses
    public function responses(){
        return $this->hasMany(Response::class);
    }
}
