@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="container" style="max-width: 600px;">
    <div class="row mb-3">
        <h1 class="display-6 text-primary">Post a Job</h1>
    </div>
    <div class="row">
        <div class="column">
            <form method="post" id="jobForm">
                @csrf
                <div class="mb-3">
                    <label for="company" class="form-label">Company</label>
                    <input type="text"
                           class="form-control"
                           id="company"
                           name="company"
                           value="{{ $job?->company ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text"
                           class="form-control"
                           id="title"
                           name="title"
                           value="{{ $job?->title ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text"
                           class="form-control"
                           id="description"
                           name="description"
                           value="{{ $job?->description ?? '' }}">
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
                    <label for="state" class="form-label">State</label>
                    <input type="text"
                           class="form-control"
                           id="state"
                           name="state"
                           value="{{ $job?->state ?? '' }}">
                </div>
                <x-tags :tags="$job?->tags"/>{{-- tags component --}}
                <button type="submit" class="btn btn-primary">{{ $job?->state ? 'Save' : 'Post' }} Job</button>
            </form>
        </div>
    </div>
</div>
@endsection
