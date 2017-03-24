<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('questionairs', 'QuestionairsController@questionairs');
    Route::get('questionairs/create', 'QuestionairsController@create');
    Route::post('questionairs/store', 'QuestionairsController@store');
    Route::get('questionair/{id}/questions', 'QuestionController@create');
    Route::get('view/questionair/{id}', 'QuestionController@show');
    Route::post('question/store', 'QuestionController@store');
    Route::get('my-exams', 'ExamsController@index');
    Route::get('questionair/{id}/exam', 'ExamsController@startExam');
    Route::post('questionair/{id}/exam', 'ExamsController@saveExam');
    Route::get('questionair/{id}/result', 'ExamsController@examResult');
});

