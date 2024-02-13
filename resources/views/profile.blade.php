{{-- Profile page will display user attributes, along with their posted and saved jobs --}}

@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="display-6 text-primary">{{ ucfirst($user->first_name) }}'s Profile</h1>
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text"
                                   class="form-control"
                                   id="first_name"
                                   name="first_name"
                                   value="{{ ucfirst($user->first_name) }}">
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text"
                                   class="form-control"
                                   id="last_name"
                                   name="last_name"
                                   value="{{ ucfirst($user->last_name) }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>
                        <x-tags :tags="$user->tags"/>{{-- tags component --}}
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <h1 class="display-6 text-primary">Saved Jobs</h1>
            <div class="card mb-3">
                <div class="card-body">
                @foreach($saved as $job)
                    <a href="/post/{{ $job->job_id }}"
                       target="_blank">{{ $job->job_title }} ({{ $job->created_at->format('M d, Y') }})</a>
                @endforeach
                </div>
            </div>
            <h1 class="display-6 text-primary">Posted Jobs</h1>
            <div class="card mb-3">
                <div class="card-body">
                @foreach($posts as $post)
                    <a href="/post/{{ $post->job_id }}"
                       target="_blank">{{ $post->job_title }} ({{ $post->created_at->format('M d, Y') }})</a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
