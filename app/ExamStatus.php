<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamStatus extends Model
{
    protected $table = 'exam_status';

    protected $fillable = ['user_id', 'questionair_id', 'remarks', 'time_left', 'status'];
}