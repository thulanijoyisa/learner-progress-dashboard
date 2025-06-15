@props(['learner'])

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
                            <span><strong>Course:</strong> {{ $enrolment->course->name ?? 'N/A' }}</span>
                            <span><strong>Progress:</strong> {{ number_format($enrolment->progress, 2) }}%</span>
                        </div>

                        {{-- Progress bar --}}
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
