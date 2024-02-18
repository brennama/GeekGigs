@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="container" style="max-width: 600px;">
    <div class="row mb-3">
        <h1 class="display-6 text-primary">Post a Job</h1>
    </div>
        <div class="row">
            <div class="col-md-6">
                    <form method="post" id="jobForm">
                        @csrf
                        @if ($job?->id ?? false)
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text"
                                class="form-control"
                                id="title"
                                name="title"
                                value="{{ $job?->title ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text"
                                class="form-control"
                                id="city"
                                name="city"
                                value="{{ $job?->city ?? '' }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="companyUrl" class="form-label">Company URL</label>
                            <input type="url"
                                class="form-control"
                                id="companyUrl"
                                name="companyUrl"
                                value="{{ $job?->companyUrl ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="salaryRangeMin" class="form-label">Salary Range Min</label>
                            <input type="number"
                                class="form-control"
                                id="salaryRangeMin"
                                name="salaryRangeMin"
                                value="{{ $job?->salaryRangeMin ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="jobType" class="form-label">Job Type</label>
                            <select class="form-select" id="jobType" name="jobType">
                                <option value="full-time">Full-time</option>
                                <option value="part-time">Part-time</option>
                                <option value="contract">Contract</option>
                                <option value="internship">Internship</option>
                                <option value="temporary">Temporary</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="remotePolicy" class="form-label">Remote Policy</label>
                            <select class="form-select" id="remotePolicy" name="remotePolicy">
                                <option value="remote">Remote</option>
                                <option value="hybrid">Hybrid</option>
                                <option value="on-site">On-site</option>
                            </select>
                        </div>       
                    </div>
                <div class="col-md-6">
                    <div class="mb-3">
                            <label for="company" class="form-label">Company</label>
                            <input type="text"
                                class="form-control"
                                id="company"
                                name="company"
                                value="{{ $job?->company ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <input type="text"
                                class="form-control"
                                id="state"
                                name="state"
                                value="{{ $job?->state ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="jobUrl" class="form-label">Job URL</label>
                            <input type="url"
                                class="form-control"
                                id="jobUrl"
                                name="jobUrl"
                                value="{{ $job?->jobUrl ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="salaryRangeMax" class="form-label">Salary Range Max</label>
                            <input type="number"
                                class="form-control"
                                id="salaryRangeMax"
                                name="salaryRangeMax"
                                value="{{ $job?->salaryRangeMax ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="experienceLevel" class="form-label">Experience Level</label>
                            <select class="form-select" id="experienceLevel" name="experienceLevel">
                                <option value="associate">Associate</option>
                                <option value="entry-level">Entry-level</option>
                                <option value="mid-level">Mid-level</option>
                                <option value="senior-level">Senior-level</option>
                                <option value="director">Director</option>
                                <option value="executive">Executive</option>
                            </select>
                        </div>
                    </div>
                <div class="row">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5">{{ $job?->description ?? '' }}</textarea>
                    </div> 
                <x-tags :tags="$job?->tags"/>{{-- tags component --}}
                <input type="hidden" name="user_id" value="{{ Auth::user()->user_id  }}">
                <button type="submit" class="btn btn-primary">{{ $job?->state ? 'Save' : 'Post' }} Job</button>
            </form>
        </div>
    </div>
</div>
@endsection

