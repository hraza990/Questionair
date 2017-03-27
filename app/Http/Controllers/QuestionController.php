<?php

namespace App\Http\Controllers;

use App\Qchoices;
use App\Question;
use App\Questionairs;
use App\Http\Requests\QuestionsReq;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function create($id) {
		$questionair = Questionairs::whereId($id)->whereUserId(Auth::id())->with('Questions')->first();
		return view('questions.create', compact('questionair', 'id'));
	}

	public function store(QuestionsReq $request, $id) {

		if ($request->has('ques')){
			
			Question::whereQuestionairId($id)->delete();
			
			foreach ($request->get('ques') as $quection){

				$que = array_merge($quection, ['questionair_id' => $id]);
				$que = Question::create($que);
				if ($que){
					if ($que->type == 1){
						$ans = array_merge(['question_id' => $que->id, 'text' => $quection['answer']]);
						Qchoices::create($ans);
					}
					elseif($que->type == 2 OR $que->type == 3){
						if (isset($quection['choices'])){
							foreach ($quection['choices'] as $choice){
								$ans = array_merge(['question_id' => $que->id, 'text' => $choice['choice'], 'correct' => isset($choice['correct']) ? 1 : 0 ]);
								Qchoices::create($ans);
							}
						}
					}
				}
			}
			return redirect()->to('questionairs')->withMessage('Data has been saved successfully..!');
		}
		return redirect()->back()->withMessage('Ooops..! There is no any question to store');
	}

}
