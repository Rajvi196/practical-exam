<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ExamRepository;

class ExamController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ExamRepository $examRepo)
    {
        $this->middleware('auth');
        $this->examRepo = $examRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = $this->examRepo->all();
       
        return view('admin.exam.list',compact('data'));
    }
    public function create()
    {
        return view('admin.exam.create');
    }
    public function store(Request $request)
    {
        $validatedInput = $request->validate([
            'exam_name' => 'required',
            'hours' => 'required',
            'minutes' => 'required',
            'seconds' => 'required'
        ]);
        
        $this->examRepo->create($validatedInput);
        return redirect()->route('exam.index')->with('success','Exam has been created successfully.');
    }
    public function edit($id)
    {
        $data = $this->examRepo->find($id); 
        return view('admin.exam.edit',compact('data'));
    }
    public function update(Request $request,$id)
    {
        $validatedInput = $request->validate([
            'exam_name' => 'required',
            'hours' => 'required',
            'minutes' => 'required',
            'seconds' => 'required'
        ]);
        $this->examRepo->update($id,$validatedInput);
        return redirect()->route('exam.index')->with('success','Exam has been created successfully.');
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
            $deleted = $this->examRepo->changestatus($id,$data);
        }else{
            $deleted = $this->examRepo->delete($id);
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
