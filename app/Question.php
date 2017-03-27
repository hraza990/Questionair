<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $table = 'questions';

	protected $fillable = ['question', 'type', 'questionair_id'];

	public function QChoices() {
		return $this->hasMany('App\Qchoices', 'question_id', 'id')
			->orderBy('id', 'asc');
	}

	public function userExam() {
		return $this->hasMany(Exam::class, 'question_id', 'id')
			->orderBy('id', 'asc');
	}

	public function RevQuestionairs() {
		return $this->belongsTo('App\Questionairs', 'id', 'questionair_id')
			->orderBy('id', 'asc');
	}
}
