@props(['learner'])

@php
    $collapseId = 'collapse-' . $learner->id;
    $averageProgress = round($learner->enrolments->avg('progress'), 2);
    $courseCount = $learner->enrolments->count();
@endphp

<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <strong>{{ $learner->full_name }}</strong>
            <span class="badge bg-primary ms-2">
                {{ $courseCount }} {{ \Illuminate\Support\Str::plural('course', $courseCount) }}
            </span>
            <span class="badge bg-info text-dark ms-1">Avg: {{ $averageProgress }}%</span>
        </div>
            <button
                class="btn btn-sm btn-outline-secondary toggle-btn"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#{{ $collapseId }}"
                aria-expanded="false"
                aria-controls="{{ $collapseId }}"
                id="btn-{{ $collapseId }}">
                <i class="bi bi-chevron-down" id="icon-{{ $collapseId }}"></i>
            </button>
    </div>

    <div id="{{ $collapseId }}" class="collapse">
        <div class="card-body">
            @if ($learner->enrolments->count())
                <ul class="list-group list-group-flush">
                    @foreach($learner->enrolments as $enrolment)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <span><strong>Course:</strong> {{ $enrolment->course->name ?? 'N/A' }}</span>
                                <span><strong>Progress:</strong> {{ number_format($enrolment->progress, 2) }}%</span>
                            </div>

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
                <p class="text-muted"><em>No course enrolments found.</em></p>
            @endif
        </div>
    </div>
</div>
