@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Learner Progress Dashboard</h1>

    {{-- Filter/Search/Sort Form --}}
    <form method="GET" action="{{ route('learner-progress.index') }}" class="row g-2 align-items-end mb-4">
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
            <a href="{{ route('learner-progress.index') }}" class="btn btn-secondary mt-2">Reset</a>
        </div>
    </form>

    {{-- Active Filters Summary --}}
    @if($search || $courseFilter)
        <div class="alert alert-info">
            <strong>Active Filters:</strong>
            @if($search) Name contains: <strong>{{ $search }}</strong> @endif
            @if($courseFilter) Course: <strong>{{ $courseFilter }}</strong> @endif
        </div>
    @endif

    {{-- Learners List --}}
    @forelse($learners as $learner)
        <x-learner-card :learner="$learner" />
    @empty
        <div class="alert alert-warning">
            No learners found matching your criteria.
        </div>
    @endforelse

    {{-- Pagination Controls --}}
        {{ $learners->links() }}

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.collapse').forEach(function (el) {
            el.addEventListener('show.bs.collapse', function () {
                const id = el.getAttribute('id');
                document.getElementById('icon-' + id).classList.remove('bi-chevron-down');
                document.getElementById('icon-' + id).classList.add('bi-chevron-up');
            });

            el.addEventListener('hide.bs.collapse', function () {
                const id = el.getAttribute('id');
                document.getElementById('icon-' + id).classList.remove('bi-chevron-up');
                document.getElementById('icon-' + id).classList.add('bi-chevron-down');
            });
        });
    });
</script>
@endsection
