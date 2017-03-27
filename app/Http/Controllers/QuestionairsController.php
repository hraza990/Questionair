<?php

namespace App\Http\Controllers;

use App\Questionairs;
use App\Http\Requests\QuestionairReq;
use Illuminate\Support\Facades\Auth;

class QuestionairsController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {
		$questionairs = Questionairs::whereUserId(Auth::id())->orderBy('id', 'ASC')->get();
		return view('questionairs.index', compact('questionairs'));
	}

	public function create() {
		return view('questionairs.create');
	}

	public function store(QuestionairReq $request) {
		$data = $request->all();
		$data = array_merge($data, ['duration'=> $data['duration'].' '.$data['duration_type'], 'user_id' => Auth::id()]);
		Questionairs::create($data);
		return redirect()->to('questionairs')->withMessage('Questionair saved successfully..!');
	}

	public function show($id){
		$questionair = Questionairs::whereId($id)->whereUserId(Auth::id())->with('Questions')->first();
		return view('questionairs.show', compact('questionair'));
	}

	public function edit($id) {
		$questionair = Questionairs::findOrFail($id);
		return view('questionairs.edit', compact('questionair'));
	}

	public function update(QuestionairReq $request, $id) {
		$data = $request->all();
		$data = array_merge($data, ['duration'=> $data['duration'].' '.$data['duration_type']]);
		$questionairs = Questionairs::findOrFail($id);
		if ($questionairs) {
			$questionairs->update($data);
			return redirect()->route('questionairs.index')->withMessage('Changes saved successfully');
		}
		return redirect()->back()->withInput()->withMessage('Ooops...! something wrong');
	}

	public function destroy($id){
		Questionairs::destroy($id);
		return redirect()->back()->withMessage('Record deleted successfully..!');
	}

}
