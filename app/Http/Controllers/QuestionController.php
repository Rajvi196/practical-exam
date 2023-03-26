<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Questionpository;

class QuestionController extends Controller
{
    public function __construct(Questionpository $queRepo)
    {
        $this->middleware('auth');
        $this->queRepo = $queRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        echo 'test';
        exit;
        $data = $this->queRepo->all();
       
        return view('admin.exam.list',compact('data'));
    }
}
