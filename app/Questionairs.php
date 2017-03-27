<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Questionairs extends Model
{
	protected $table = 'questionair';

	protected $fillable = ['name', 'duration', 'user_id', 'resumeable', 'published'];

	public function Questions() {
		return $this->hasMany('App\Question', 'questionair_id', 'id')
			->orderBy('id', 'asc');
	}

	public function QuestionsCount() {
		return $this->Questions()
			->selectRaw('questionair_id, count(*) as Count')
			->groupBy('questionair_id');
	}

	public function userExamStatus() {
		return $this->hasOne(ExamStatus::class, 'questionair_id', 'id')->whereUserId(Auth::id());
	}

}