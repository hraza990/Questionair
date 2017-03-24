<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionairs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Form;

class QuestionairsController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

	public function questionairs() {
		$questionairs = Questionairs::whereUserId(Auth::id())->with('QuestionsCount')->orderBy('id', 'ASC')->get();
		//dd($questionairs);
			return View::make('questionairs.index', compact('questionairs'));
	}

	public function create() {
		//dd('ok');
		return View::make('questionairs.create');
	}

	public function store(Request $request) {
		//dd($request->all());

		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'questionair_name'      => 'required',
			'duration'    			=> 'required',
			'resumeable'  			=>  'required|boolean|in:0,1',
		);
		$validator = \Validator::make($request->all(), $rules);

		// process the login
		if ($validator->fails()) {
			return \Redirect::back()
				->withErrors($validator)
				->withInput($request->all());
		} else {
			// Questionairs
			$questionair = new Questionairs();
				$questionair->name = $request['questionair_name'];
				$questionair->duration = $request['duration'].' '.$request['duration_type'];
				$questionair->user_id = Auth::id();
				$questionair->resumeable = $request['resumeable'];
				$questionair->published = $request['published'];
			$questionair->save();
		}

		return \Redirect::to('/questionairs')->withMessage('The [ '.$request['questionair_name'].' ] saved successfully..!');
	}

}
