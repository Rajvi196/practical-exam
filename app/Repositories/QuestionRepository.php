<?php
namespace App\Repositories;

use App\Repositories\IdmMain;
use App\Models\Question;
use App\Models\Exam;
use App\Models\Answer;
use Carbon\Carbon;
use Illuminate\Support\Facades\File; 

class QuestionRepository implements IdmMain {

    private $model;
    private $data;
    private $where   = array();
    private $orWhere = array();
    private $isFiter = false;

    /* Constructor */
    public function __construct(Question $question)
    {
        $this->question = $question;
       
    }

    /* Get All Users */
    public function all($columns = [], $model_type = NULL)
    {

        return $this->question->get();
        
    }

    /* Find User */
    public function find($id)
    {
        return $this->question->with('answer')->findOrFail($id);
    }

    /* Create New User */
    public function create(array $data)
    {
        
        if(isset($data['image'])){
            $imageName = time().'.'.$data['image']->extension();
            $data['image']->move(public_path('images'), $imageName);
        }else{
            $imageName ='';
        }
       

        $exam = Exam::findOrFail($data['question_id']);
        $question = new Question();
        $question->exam_id = $data['question_id'];
        $question->title = $data['title'];
        $question->description = $data['description'];
        $question->image = $imageName;
        $question->marks = $data['marks'];
        $exam->question()->save($question);
        
        $question1 = Question::findOrFail($question->id);
        $i = 0;
        foreach($data['answer'] as $answer1){
            if($i == 0){
                $is_true1 = '1';
                $i++;
            }else{
                $is_true1 = '0';
            }
            $answer = new Answer();
            $answer->title = $answer1;
            $answer->is_true = $is_true1;
            $question1->answer()->save($answer);
        }
        
    }

    /* Update User Data */
    public function update($id, array $attributes)
    {
        if(isset($attributes['image'])){
            $question = Question::findOrFail($id);
            if (file_exists( public_path().'/images/'.$question->image)) {
                File::delete( public_path().'/images/'.$question->image);
            }
            $imageName = time().'.'.$attributes['image']->extension();
            $attributes['image']->move(public_path('images'), $imageName);
            
        }else{
            $imageName ='';
        }
       
        $data = array(
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'marks' => $attributes['marks'],
            'image' => $imageName
        );
        $answers = Answer::where('question_id',$id)->get();
        foreach($answers as $key=>$ans){
            Answer::where('id',$ans->id)->update(['title'=>$attributes['answer'][$key]]);
        }
        
        return $this->question->find($id)->update($data);
    }

    /* Delete User */
    public function delete($id)
    {
        
        return $this->question->find($id)->delete();
    }

    public function changestatus($id,$data)
    {
        return $this->question->find($id)->update($data);
    }
    public function questionList($id)
    {
       return $this->question->with('answer')->where('exam_id',$id)->get();
    }
    

} 