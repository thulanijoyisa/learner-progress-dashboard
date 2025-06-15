<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Learner;
use App\Models\Course;

class LearnerProgressController extends Controller
{
     public function index(Request $request)
{
    $courseFilter = $request->query('course');
    $sortOrder = $request->query('sort', 'desc');
    $search = $request->query('search');

    $query = Learner::with(['enrolments.course'])
        ->when($courseFilter, function ($query) use ($courseFilter) {
            $query->whereHas('courses', function ($q) use ($courseFilter) {
                $q->where('name', $courseFilter);
            });
        })
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%");
            });
        });
       
    $learners = $query->paginate(10)->appends(request()->query());
    $courses = Course::orderBy('name')->pluck('name');

    return view('learner-progress.index', compact('learners', 'courses', 'courseFilter', 'sortOrder', 'search'));
}

}
