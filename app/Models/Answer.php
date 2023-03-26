<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'questions_answers';  
    protected $fillable = ['question_id ','title','is_true','time'];

    public function answer(){
        return $this->belongsTo('App\Models\Question');
    }
}