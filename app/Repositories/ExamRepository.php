<?php
namespace App\Repositories;

use App\Repositories\IdmMain;
use App\Models\Exam;
use Carbon\Carbon;

class ExamRepository implements IdmMain {

    private $model;
    private $data;
    private $where   = array();
    private $orWhere = array();
    private $isFiter = false;

    /* Constructor */
    public function __construct(Exam $exam)
    {
        $this->exam    = $exam;
       
    }

    /* Get All Users */
    public function all($columns = [], $model_type = NULL)
    {

        return $this->exam->with('question')->get();
        
    }

    /* Find User */
    public function find($id)
    {
        return $this->exam->findOrFail($id);
    }

    /* Create New User */
    public function create(array $attributes)
    {
        $time = $attributes['hours'].':'.$attributes['minutes'].':'.$attributes['seconds'];
        $data = array('name' => $attributes['exam_name'],
            'time' =>$time
        );
      
        return $this->exam->create($data);
    }

    /* Update User Data */
    public function update($id, array $attributes)
    {
        $time = $attributes['hours'].':'.$attributes['minutes'].':'.$attributes['seconds'];
        $data = array('name' => $attributes['exam_name'],
            'time' =>$time
        );
        return $this->exam->find($id)->update($data);
    }

    /* Delete User */
    public function delete($id)
    {
        
        return $this->exam->find($id)->delete();
    }

    public function changestatus($id,$data)
    {
        return $this->exam->find($id)->update($data);
    }
   
} 