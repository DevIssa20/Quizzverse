<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizze extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters){

        if(!isset($filters['tag']) && !isset($filters['search'])){
            $query->where('private', 'equal', False);
        }

        if(isset($filters['tag'])){
            $query->where('private', 'equal', False)
            ->where('tags', 'like', "%" . request('tag') . "%");
        }

        if(isset($filters['search'])){

            $query->where('private', 'equal', False)
            ->where(function($query){
                $query->where('title', 'like', "%" . request('search') . "%")
                ->orwhere('description', 'like', "%" . request('search') . "%")
                ->orwhere('tags', 'like', "%" . request('search') . "%");
            });

        }
    }

    // Relationship to User
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Question
    public function questions(){
        return $this->hasMany(Question::class);
    }

    // Relationship with Responses
    public function responses(){
        return $this->hasMany(Response::class);
    }

}
