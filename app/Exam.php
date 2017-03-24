<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'user_exams';

    public $timestamps = false;

    protected $fillable = ['user_id', 'question_id', 'choice_id', 'text_answer'];

    public function exmChoice() {
        return $this->hasOne(Qchoices::class, 'id', 'choice_id')
            ->orderBy('id', 'asc');
    }

    public function examQuestion() {
        return $this->hasOne(Question::class, 'question_id', 'id')->first();
    }

    public function examUser() {
        return $this->hasOne(User::class, 'user_id', 'id')->first();
    }
}
