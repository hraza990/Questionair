<?php

namespace App\Http\Controllers;

use App\Exam;
use App\ExamStatus;
use App\Http\Requests\ExamReq;
use App\Question;
use App\Questionairs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class ExamsController extends Controller
{
    public function index() {
		$questionairs = Questionairs::with('userExamStatus')->orderBy('id', 'ASC')->get();
		return view('exams.index', compact('questionairs'));
	}

	public function startExam(Request $request, $id){

		$questionair = Questionairs::whereId($id)->with('Questions')->first();
		
			if ($request->has('resume')){
				$duration = $questionair->userExamStatus->time_left;
				$duration = explode(':', $duration);
				$duration = Carbon::now()->addHour($duration[0])->addMinute($duration[1])->addSecond($duration[2])->format('Y/m/d H:i:s');
			}else{
				$duration = $questionair->duration;
				$duration = explode(' ', $duration);
				$duration[1] == 'hr' ? $duration = Carbon::now()->addHour($duration[0])->format('Y/m/d H:i:s') : $duration = Carbon::now()->addMinute($duration[0])->format('Y/m/d H:i:s');
			}
		
		return view('exams.create', compact('questionair', 'duration', 'id'));
	}

	public function saveExam(ExamReq $request, $id){
		
		$userId = Auth::id();
		ExamStatus::whereQuestionairId($id)->whereUserId($userId)->delete();

		// Save Exam Answers
		if ($request->has('ques')){
			foreach ($request->get('ques') as $myExam){
				Exam::whereQuestionId($myExam['question_id'])->whereUserId($userId)->delete();

				if (isset($myExam['text_answer']) OR isset($myExam['choice_id'])){
					$ans = array_merge($myExam, ['user_id' => $userId]);
					Exam::create($ans);
				}

				if (isset($myExam['choices'])){
					foreach ($myExam['choices'] as $choice){
						$ans = array_merge(array_except($myExam, ['choices']), $choice, ['user_id' => $userId]);
						Exam::create($ans);
					}
				}
			}

			$examStatus = ExamStatus::firstOrCreate(array('user_id' => $userId, 'questionair_id' => $id));
				$examStatus->user_id 			= $userId;
				$examStatus->questionair_id 	= $id;
				$examStatus->time_left 			= $request->has('pause') ? $request->input('testtime') : '';
				$examStatus->remarks 			= $request->has('pause') ? 'pause' : 'Completed';
				$examStatus->status 			= $request->has('pause') ? 0 : 1;
			$examStatus->save();
		}

		$request->has('pause') ? $msg = 'Exam paused successfully..!' : $msg = 'Best of Luck... Your exam has been saved successfully..!';

		return \Redirect::to('my-exams')->withMessage($msg);
	}
	
	public function examResult($id) {

		$questionair = Questionairs::whereId($id)->with('userExamStatus', 'questions')->first();
		return view('exams.result', compact('questionair'));

	}

}
