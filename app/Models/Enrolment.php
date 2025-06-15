<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Learner;
use App\Models\Course;


class Enrolment extends Model
{
 
    public $incrementing = false;
    protected $table = 'enrolments';
    protected $fillable = ['learner_id','course_id','progress',];
    protected $casts = ['progress' => 'decimal:2',];

    public function learner()
    {
        return $this->belongsTo(Learner::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
