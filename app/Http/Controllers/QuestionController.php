<?php

namespace App\Http\Controllers;

use App\Qchoices;
use App\Question;
use App\Questionairs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class QuestionController extends Controller
{
    public function create($id) {
		//dd($id);
		$questionair = Questionairs::whereId($id)->whereUserId(Auth::id())->with('QuestionsCount')->first();
		$questions = Question::whereQuestionairId($id)->with('QChoices')->orderBy('id', 'ASC')->get();
		//dd($questions);
		return View::make('questions.create', compact('id', 'questionair', 'questions'));
	}

	public function store(Request $request) {
		//dd($request->all());
		$questionair_id = $request->get('questionair_id');

		Question::whereQuestionairId($questionair_id)->delete();

		if ($request->has('ques')){
			foreach ($request->get('ques') as $quection){
				if ($quection['type'] == 1){
					// Question Save
					$question = new Question();
					$question->question = $quection['question'];
					$question->type = $quection['type'];
					$question->questionair_id = $questionair_id;
					$question->save();
					if ($question){
						// Answer Save
						$answer = new Qchoices();
						$answer->question_id = $question->id;
						$answer->text = $quection['answer'];
						$answer->save();
					}
				}
				elseif ($quection['type'] == 2){
					// Question Save
					$question = new Question();
					$question->question = $quection['question'];
					$question->type = $quection['type'];
					$question->questionair_id = $questionair_id;
					$question->save();
					if ($question){
						if (isset($quection['choices'])){
							foreach ($quection['choices'] as $choice){
								// Choices Save
								$answer = new Qchoices();
								$answer->question_id = $question->id;
								$answer->text = $choice['choice'];
								if (isset($choice['correct'])){
									$answer->correct = 1;
								}
								$answer->save();
							}
						}

					}
				}
				elseif ($quection['type'] == 3){
					// Question Save
					$question = new Question();
					$question->question = $quection['question'];
					$question->type = $quection['type'];
					$question->questionair_id = $questionair_id;
					$question->save();
					if ($question){
						if (isset($quection['choices'])){
							foreach ($quection['choices'] as $choice){
								// Choices Save
								$answer = new Qchoices();
								$answer->question_id = $question->id;
								$answer->text = $choice['choice'];
								if (isset($choice['correct'])){
									$answer->correct = 1;
								}
								$answer->save();
							}
						}
					}
				}
			}
		}

		return \Redirect::to('questionairs')->withMessage('Data has been saved successfully..!');
	}
	
	public function show($id){
		$questionair = Questionairs::whereId($id)->whereUserId(Auth::id())->with('QuestionsCount')->first();
		$questions = Question::whereQuestionairId($id)->with('QChoices')->orderBy('id', 'ASC')->paginate(15);
		//dd($question);
		return View::make('questionairs.show', compact('questions', 'questionair'));
	}

}
