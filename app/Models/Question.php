<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'questions';  
    protected $fillable = ['id','question_id ','title','description','marks','image','status'];

    public function exam(){
        return $this->belongsTo('App\Models\Exam');
    }
    public function answer(){
        return $this->hasMany('App\Models\Answer','question_id','id');
    }
    public static function boot() {
        parent::boot();
        static::deleting(function($question) {
            foreach ($question->answer as $answer) {
                $answer->delete();
            }
        });
    }
    
        
}