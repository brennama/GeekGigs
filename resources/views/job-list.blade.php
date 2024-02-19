@extends('layouts.app')

@section('title', 'Search for Jobs')

@section('content')
<div class="container-fluid">
    @if (empty($term))
    <div class="container">
        <x-alerts/>{{-- alerts component --}}
    </div>
    @endif
    <div class="row mb-3 text-center">
        <h1 class="display-6 text-primary">Search for Jobs</h1>
    </div>
    <div class="row mb-5 justify-content-center">
        <div class="col-md-4">
            <form method="get">
                <div class="input-group mb-3">
                    <input type="text"
                           class="form-control"
                           name="term"
                           value="{{ $term ?? '' }}"
                           aria-label="Search"
                           aria-describedby="search"
                           placeholder="search...">
                    <button class="btn btn-outline-secondary" type="submit" id="search">Search</button>
                </div>

            </form>
        </div>
    </div>
@if (!empty($term))
    @if ($totalResults === 0)
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="alert alert-warning" role="alert">
                    Search did not yield any results.
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row flex-grow-1">
        <div class="col-md-2">
            <div class="h-100 d-flex flex-column">
                <form method="get">
                <h5>Filter Options</h5>
                    <input type="hidden" name="term" value="{{ $term }}">
                    <div class="mb-2"><x-job-type/>{{-- job type component --}}</div>
                    <div class="mb-2"><x-remote-policy/>{{-- remote policy component --}}</div>
                    <div class="mb-2"><x-experience-level/>{{-- experience level component --}}</div>
                    <button class="btn btn-outline-secondary btn-sm" type="submit" id="search">Filter</button>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="h-100 overflow-auto" id="jobsList" style="max-height: 80vh;">
                <h5>Job List ({{ $totalResults }})</h5>
                @foreach ($jobs as $job)
                <div class="card mb-2">
                    <div class="card-body">
                        <span class="float-end">
                            <small>
                            ${{ number_format($job->salaryRangeMin) }} - ${{ number_format($job->salaryRangeMax) }}
                            </small>
                        </span>
                        <h5 class="card-title">{{ $job->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">{{ $job->company }}</h6>
                        <p class="card-text">
                            <small>{{ $job->city }}, {{ $job->state }}</small>
                        </p>
                        @foreach($job->tags as $tag)
                            <span role="button"
                                  class="badge rounded-pill text-bg-light ms-1 me-1"
                                  id="tag-{{ $tag['id'] }}">{{ $tag['label'] }}</span>
                        @endforeach
                        <button type="button"
                                id="{{ $job->id }}"
                                class="btn btn-outline-primary btn-view float-end"
                                style="">View
                        </button>
                    </div>
                </div>
                @endforeach
                <nav aria-label="job pagination">
                    <ul class="pagination pagination-sm justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="/jobs/?term={{ $term }}&page=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $totalPages; $i++)
                        <li class="page-item {{ $page === $i ? 'active' : '' }}">
                            <a class="page-link" href="/jobs/?term={{ $term }}&page={{$i}}">{{$i}}</a>
                        </li>
                        @endfor
                        <li class="page-item">
                            <a class="page-link" href="/jobs/?term={{ $term }}&page={{$totalPages}}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-md-6">
            <div class="position-relative h-100" id="jobContainer">
                <div class="h-100 overflow-auto" style="max-height: 80vh;">
                    <h5>Job Details</h5>
                    <div class="card mb-2">
                        <div class="card-body" id="jobBody">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endif
</div>
@endsection

@push('body_scripts')
<script>
$(document).ready(() => {
    const jobs = {{ Illuminate\Support\Js::from($jobs) }};
    const keys = Object.keys(jobs);

    // Display first job by default
    if (keys.length > 0) {
        display(jobs[keys[0]]);
    }

    $('.container-fluid').on('click', '.btn-view', (event) => {
        $('.card').removeClass('border-primary');
        let job = jobs[event.target.id];
        display(job);
        return false;
    });
});

function display(job) {
    $('#'+job['id']).closest('.card').addClass('border-primary')
    const nf = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        maximumFractionDigits: 0,
        minimumFractionDigits: 0,
    });

    const tags = job['tags'];
    let tagHtml = '';
    let createdAt = '';
    @if (!empty($job?->createdAt))
    createdAt = 'Posted on {{ $job->createdAt->format('M d, Y') }}';
    @endif
    let salaryHtml = '<small>'+nf.format(job['salaryRangeMin'])+' - '+nf.format(job['salaryRangeMax'])+'</small>';
    for (let index in tags) {
        tagHtml += `<span role="button"
              class="badge rounded-pill text-bg-light ms-1 me-1"
              id="tag-${tags[index]['id']}">${tags[index]['label']}</span>`
    }

    $('#jobBody').empty().html(`
    <div class="row mb-3">
        <div class="col">
            <h5 class="card-title mb-0">${job['title']}</h5>
            <small class="text-secondary">${createdAt}</small>
        </div>
        <div class="col-auto">
            <a href="/jobs/${job['id']}" class="btn btn-outline-primary btn-view" target="_blank">Open Job</a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <p>${job['company']}<br>
                <small>
                    <a class="link-secondary" target="_blank" href="${job['companyUrl']}">${job['companyUrl']}</a><br>
                    ${job['city']}, ${job['state']}
                </small>
            </p>
        </div>
        <div class="col">
            <span><small><strong>Job Type:</strong> ${job['jobType']}</small></span><br>
            <span><small><strong>Remote Policy:</strong> ${job['remotePolicy']}</small></span><br>
            <span><small><strong>Experience Level:</strong> ${job['experienceLevel']}</small></span><br>
            <span><small><strong>Salary Range:</strong> ${salaryHtml}</small></span>
        </div>
    </div>
    <p><small><strong>Description: </strong>${job['description']}</small></p>
    <a class="btn btn-outline-primary btn-apply float-end" href="${job['jobUrl']}" target="_blank">Apply Now</a>
    <div class="mt-3">
        ${tagHtml}
    </div>
    `);
}
</script>
@endpush
