<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $table = 'exam_details';  
    protected $fillable = ['id','name','status','time'];

    public function question(){
        return $this->hasMany('App\Models\Question','exam_id','id');
    }
    public static function boot() {
        parent::boot();
        static::deleting(function($exam) {
            foreach ($exam->question as $question) {
                $question->delete();
            }
        });
    }
}