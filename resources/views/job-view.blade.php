@extends('layouts.app')

@section('title', $job->title)

@section('content')
<div class="container">
    <div class="row mb-3 text-center">
        <h1 class="display-6 text-primary">
            {{ $job->title }} at {{ $job->company }}
            @if (!empty($job->archived))<span class="text-danger">[ARCHIVED]</span>@endif
        </h1>
    </div>
    <div class="row">
        <div class="col">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <h5 class="card-title">{{ $job->title }}</h5>
                            <small class="text-secondary">Posted on {{ $job->createdAt->format('M d, Y') }}</small>
                        </div>
                        @auth
                        @if (empty($job->archived))
                        <div class="col-auto">
                            <x-save :job="$job" :saved="$saved"/>{{-- save job component --}}
                        </div>
                        @endif
                        @endauth
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <p>{{ $job->company }}<br>
                                <small>
                                    <a class="link-secondary" href="{{ $job->companyUrl }}">
                                        {{ $job->companyUrl }}
                                    </a>
                                    <br>
                                    {{ $job->city }}, {{ $job->state }}
                                </small>
                            </p>
                        </div>
                        <div class="col">
                            <span>
                                <small><strong>Job Type:</strong> {{ $job->jobType }}</small>
                            </span>
                            <br>
                            <span>
                                <small><strong>Remote Policy:</strong> {{ $job->remotePolicy }}</small>
                            </span>
                            <br>
                            <span>
                                <small><strong>Experience Level:</strong> {{ $job->experienceLevel }}</small>
                            </span>
                            <br>
                            <span>
                                <small>
                                    <strong>Salary Range:</strong>
                                    ${{ number_format($job->salaryRangeMin) }} -
                                    ${{ number_format($job->salaryRangeMax) }}
                                </small>
                            </span>
                        </div>
                    </div>
                    <p><small><strong>Description: </strong>{{ $job->description }}</small></p>
                    <a class="btn btn-outline-primary btn-apply float-end"
                       href="{{ $job->jobUrl }}" target="_blank">Apply Now</a>
                    <div class="mt-3">
                    @foreach($job->tags as $tag)
                        <span role="button" style="cursor:default;"
                              class="badge rounded-pill text-bg-light ms-1 me-1"
                              id="tag-{{ $tag['id'] }}">{{ $tag['label'] }}</span>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
