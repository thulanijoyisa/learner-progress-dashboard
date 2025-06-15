<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Enrolment;
use App\Models\Course;

class Learner extends Model
{
   use HasFactory;
   

    protected $fillable = ['firstname', 'lastname'];

    public function enrolments()
    {
        return $this->hasMany(Enrolment::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrolments')
            ->withPivot('progress')
            ->withTimestamps();
    }

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
