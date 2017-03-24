<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Qchoices extends Model
{
    public $timestamps = false;

	protected $table = 'q_choices';

	protected $fillable = ['question_id', 'text', 'correct'];

	public function RevQuestion() {
		return $this->belongsTo('App\Question', 'id', 'question_id')
			->orderBy('id', 'asc');
	}

	public function examChoices() {
		return $this->hasMany(Exam::class, 'choice_id', 'id')->whereUserId(Auth::id())
			->orderBy('id', 'asc');
	}
}
