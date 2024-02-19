@extends('layouts.app')

@section('title', 'Post a Job')

@section('content')
<div class="container" style="max-width:800px;">
    <x-alerts/>{{-- alerts component --}}
    <div class="row mb-3">
        <h1 class="display-6 {{ $job?->archived ? 'text-danger' : 'text-primary' }}">
            {{ $job?->archived ? 'Archived Job' : 'Post a Job' }}
        </h1>
    </div>
    <form method="post" id="jobForm" action="">
        <div class="row">
            <div class="col-md-6">
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
                        value="{{ $job?->title ?? old('title') ?? '' }}" required tabindex="1">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text"
                        class="form-control"
                        id="city"
                        name="city"
                        value="{{ $job?->city ?? old('city') ?? '' }}" required tabindex="3">
                </div>
                <div class="mb-3">
                    <label for="companyUrl" class="form-label">Company URL</label>
                    <input type="url"
                        class="form-control"
                        id="companyUrl"
                        name="companyUrl"
                        value="{{ $job?->companyUrl ?? old('companyUrl') ?? '' }}" tabindex="5">
                </div>
                <div class="mb-3">
                    <label for="salaryRangeMin" class="form-label">Salary Range Min</label>
                    <input type="number"
                        class="form-control"
                        id="salaryRangeMin"
                        name="salaryRangeMin"
                        value="{{ $job?->salaryRangeMin ?? old('salaryRangeMin') ?? '' }}" required tabindex="7">
                </div>
                <div class="mb-3">
                    <label for="jobType" class="form-label">Job Type</label>
                    <x-job-type tabindex="9" required="1"/>{{-- job type component --}}
                </div>
                <div class="mb-3">
                    <label for="remotePolicy" class="form-label">Remote Policy</label>
                    <x-remote-policy tabindex="11" required="1"/>{{-- remote policy component --}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="company" class="form-label">Company</label>
                    <input type="text"
                        class="form-control"
                        id="company"
                        name="company"
                        value="{{ $job?->company ?? old('company') ?? '' }}" required tabindex="2">
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">State</label>
                    <x-states tabindex="4" required="1"/>{{-- states component --}}
                </div>
                <div class="mb-3">
                    <label for="jobUrl" class="form-label">Job URL</label>
                    <input type="url"
                        class="form-control"
                        id="jobUrl"
                        name="jobUrl"
                        value="{{ $job?->jobUrl ?? old('jobUrl') ?? '' }}" required tabindex="6">
                </div>
                <div class="mb-3">
                    <label for="salaryRangeMax" class="form-label">Salary Range Max</label>
                    <input type="number"
                        class="form-control"
                        id="salaryRangeMax"
                        name="salaryRangeMax"
                        value="{{ $job?->salaryRangeMax ?? old('salaryRangeMax') ?? '' }}" required tabindex="8">
                </div>
                <div class="mb-3">
                    <label for="experienceLevel" class="form-label">Experience Level</label>
                    <x-experience-level tabindex="10" required="1"/>{{-- experience level component --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control"
                          id="description"
                          name="description"
                          rows="5"
                          tabindex="12">{{ $job?->description ?? old('description') ??  '' }}</textarea>
            </div>
            <div class="mb-3">
                <x-tags :tags="$job?->tags" tabindex="13"/>{{-- tags component --}}
                <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                <input type="hidden" name="archived" value="{{ $job?->archived ? 1 : 0 }}">
                <button type="submit"
                        class="btn {{ $job?->archived ? 'btn-outline-danger' : 'btn-primary' }}"
                        tabindex="14">
                    {{ $job?->archived ? 'Post as New Job' : ($job?->id ? 'Save' : 'Post') }} Job
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

