<?php

namespace App\Http\Controllers;

use App\Exam;
use App\ExamStatus;
use App\Question;
use App\Questionairs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class ExamsController extends Controller
{
    public function index() {
		$questionairs = Questionairs::with('userExamStatus', 'QuestionsCount')->orderBy('id', 'ASC')->get();
		//dd($questionairs);
		return View::make('exams.index', compact('questionairs'));
	}

	public function startExam(Request $request, $id){

		$questionair = Questionairs::whereId($id)->with('QuestionsCount')->first();

		//dd($request->all());

		// Exam Duration
		if ($request->has('resume')){
			$duration = $questionair->userExamStatus->time_left;
			$duration = explode(':', $duration);
			$duration = Carbon::now()->addHour($duration[0])->addMinute($duration[1])->addSecond($duration[2])->format('Y/m/d H:i:s');
		}else{
			$duration = $questionair->duration;
			$duration = explode(' ', $duration);
			$duration[1] == 'hr' ? $duration = Carbon::now()->addHour($duration[0])->format('Y/m/d H:i:s') : $duration = Carbon::now()->addMinute($duration[0])->format('Y/m/d H:i:s');
		}
		$questions = Question::whereQuestionairId($id)->with('QChoices.examChoices')->orderBy('id', 'ASC')->paginate(15);
		//dd($questions);
		return View::make('exams.create', compact('questions', 'questionair', 'duration', 'id'));
	}

	public function saveExam(Request $request, $id){

		//dd($request->all());

		$userId = Auth::id();
		ExamStatus::whereQuestionairId($id)->whereUserId($userId)->delete();

		// Save Exam Answers
		if ($request->has('ques')){
			foreach ($request->get('ques') as $myExam){
				if ($myExam['type'] == 1){
					Exam::whereQuestionId($myExam['question_id'])->whereUserId($userId)->delete();
					if (isset($myExam['answer'])){
						$exam = new Exam();
						$exam->user_id = $userId;
						$exam->question_id = $myExam['question_id'];
						$exam->text_answer = $myExam['answer'];
						$exam->choice_id = $myExam['choice'];
						$exam->save();
					}
				}
				elseif ($myExam['type'] == 2){
					Exam::whereQuestionId($myExam['question_id'])->whereUserId($userId)->delete();
					if (isset($myExam['choice'])){
						$exam = new Exam();
						$exam->user_id = $userId;
						$exam->question_id = $myExam['question_id'];
						$exam->choice_id = $myExam['choice'];
						$exam->save();
					}

				}
				elseif ($myExam['type'] == 3){

					Exam::whereQuestionId($myExam['question_id'])->whereUserId($userId)->delete();
					if (isset($myExam['choices'])){
						foreach ($myExam['choices'] as $choice){
							$exam = new Exam();
							$exam->user_id = $userId;
							$exam->question_id = $myExam['question_id'];
							$exam->choice_id = $choice['choice'];
							$exam->save();
						}
					}
				}
			}

			$examStatus = ExamStatus::firstOrCreate(array('user_id' => $userId, 'questionair_id' => $id));
			$examStatus->user_id = $userId;
			$examStatus->questionair_id = $id;
			if ($request->has('pause')){
				$examStatus->time_left = $request->input('testtime');
				$examStatus->remarks = 'pause';
				$examStatus->status = 0;
			}
			else{
				$examStatus->remarks = 'Completed';
				$examStatus->status = 1;
			}
			$examStatus->save();
		}

		return \Redirect::to('my-exams')->withMessage('Best of Luck... Your exam has been saved successfully..!');
	}
	
	public function examResult($id) {

		$questionair = Questionairs::whereId($id)->with('userExamStatus', 'QuestionsCount')->first();
		$questions = Question::whereQuestionairId($id)->with('QChoices.examChoices')->orderBy('id', 'ASC')->get();
		//dd($questions);

		return View::make('exams.result', compact('questions', 'questionair'));

	}

}
