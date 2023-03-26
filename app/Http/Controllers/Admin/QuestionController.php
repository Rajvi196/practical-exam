<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\QuestionRepository;

class QuestionController extends Controller
{
    public function __construct(QuestionRepository $queRepo)
    {
        $this->middleware('auth');
        $this->queRepo = $queRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        $id= $request->id;
        
        return view('admin.question.create',compact('id'));
       
    }
    public function show($id)
    {   
        $data = $this->queRepo->questionList($id);
        return view('admin.question.list',compact('data','id'));
    }
    public function store(Request $request)
    {
        $id = $request->question_id;
        $validatedInput = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'answer' => 'required',
            'marks' => 'required',
        ]);
        if ($validatedInput) {
            $this->queRepo->create($request->all());
        }
        
        return redirect()->route('question.show',$id)->with('success','Question has been created successfully.');
        
    }
    public function edit($id)
    {
        $data = $this->queRepo->find($id);
        
        return view('admin.question.edit',compact('data'));
    }
    public function update(Request $request,$id)
    {
        $validatedInput = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'answer' => 'required',
            'marks' => 'required',
        ]);
        if ($validatedInput) {
            $exam_id = $request->exam_id;
            $this->queRepo->update($id,$request->all());
        }
        return redirect()->route('question.show',$exam_id)->with('success','Exam has been created successfully.');
    }
    public function destroy(Request $request,$id)
    {
        if(isset($request->status)){
            if($request->status == '1'){
                $status = '0';
            }else{
                $status = '1';
            }
            $data = array('status' => $status);
            $deleted = $this->queRepo->changestatus($id,$data);
        }else{
            $deleted = $this->queRepo->delete($id);
        }
        
        if($deleted){
            $data['type'] = "success";
            $data['msg'] = "Exam has been deleted successfully.";
        } else {
            $data['type'] = "error";
            $data['msg'] = "Error in Exam delete.";
        }
        return response()->json($data);
    }
}
