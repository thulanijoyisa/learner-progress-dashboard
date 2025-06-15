@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">📊 Learner Progress Dashboard</h1>

<form method="GET" action="{{ url('/learner-progress') }}" class="row g-2 align-items-end mb-3">
    <div class="col-md-4">
        <label for="search" class="form-label">Search Learner</label>
        <input type="text" name="search" id="search" class="form-control"
            placeholder="e.g. Musa or Ndlovu" value="{{ $search }}">
    </div>

    <div class="col-md-4">
        <label for="course" class="form-label">Filter by Course</label>
        <select name="course" id="course" class="form-select">
            <option value="">-- Show All Courses --</option>
            @foreach($courses as $course)
                <option value="{{ $course }}" {{ $course == $courseFilter ? 'selected' : '' }}>
                    {{ $course }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label for="sort" class="form-label">Sort by Progress</label>
        <select name="sort" id="sort" class="form-select">
            <option value="desc" {{ $sortOrder === 'desc' ? 'selected' : '' }}>Highest Progress First</option>
            <option value="asc" {{ $sortOrder === 'asc' ? 'selected' : '' }}>Lowest Progress First</option>
        </select>
    </div>

    <div class="col-md-12 text-end">
        <button type="submit" class="btn btn-primary mt-2">Apply</button>
        <a href="{{ url('/learner-progress') }}" class="btn btn-secondary mt-2">Reset</a>
    </div>
</form>

@if($search || $courseFilter)
    <div class="alert alert-info mt-2">
        <strong>Active Filters:</strong>
        @if($search) <span>🔍 Name contains: "<strong>{{ $search }}</strong>"</span> @endif
        @if($courseFilter) <span>📚 Course: "<strong>{{ $courseFilter }}</strong>"</span> @endif
    </div>
@endif

    @forelse($learners as $learner)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">{{ $learner->full_name }}</h5>
            </div>
            <div class="card-body">
                @if ($learner->enrolments->count())
                    <ul class="list-group list-group-flush">
                        @foreach($learner->enrolments as $enrolment)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <span>
                                        <strong>Course Enrolled:</strong> {{ $enrolment->course->name ?? 'N/A' }}
                                    </span>
                                    <span>
                                        <strong>Progress:</strong> {{ number_format($enrolment->progress, 2) }}%
                                    </span>
                                </div>
                                {{-- Optional progress bar --}}
                                <div class="progress mt-2" style="height: 8px;">
                                    <div class="progress-bar 
                                        @if($enrolment->progress >= 75)
                                            bg-success
                                        @elseif($enrolment->progress >= 50)
                                            bg-warning
                                        @else
                                            bg-danger
                                        @endif"
                                        role="progressbar"
                                        style="width: {{ $enrolment->progress }}%;"
                                        aria-valuenow="{{ $enrolment->progress }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted mb-0"><em>No course enrolments found.</em></p>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            No learners found.
        </div>
       
    @endforelse
</div>
@endsection
 