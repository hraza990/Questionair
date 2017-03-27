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
    Route::resource('questionairs', 'QuestionairsController');
    Route::get('questionair/{id}/add-questions', 'QuestionController@create')->name('questionair.questions.create');
    Route::post('questionair/{id}/questions', 'QuestionController@store')->name('questionair.questions.store');
    Route::get('my-exams', 'ExamsController@index')->name('exams.index');
    Route::get('questionair/{id}/exam', 'ExamsController@startExam');
    Route::post('questionair/{id}/exam', 'ExamsController@saveExam');
    Route::get('questionair/{id}/result', 'ExamsController@examResult');
});

