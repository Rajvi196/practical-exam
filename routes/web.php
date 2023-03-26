<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\QuestionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['prefix' => 'admin/',  'middleware' => 'is_admin'], function(){
    Route::resource('/exam', ExamController::class);
    Route::resource('/question', QuestionController::class);
    Route::get('/question/create/{$id}', [QuestionController::class, 'createQuestion'])->name('question.create');
   
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
