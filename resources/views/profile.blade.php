{{-- Profile page will display user attributes, along with their posted and saved jobs --}}

@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container">
    <x-alerts/>{{-- alerts component --}}
    <div class="row mb-3">
        <div class="col">
            <h1 class="display-6 text-primary">{{ ucfirst($user->first_name) }}'s Profile</h1>
            <div class="card mb-3">
                <div class="card-body">
                    <form method="post" action="{{ request()->fullUrl() }}">
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
                        <button type="submit" class="btn btn-primary btn-save">Save</button>
                    </form>
                </div>
            </div>
            <h1 class="display-6 text-primary">Change Password</h1>
            <div class="card mb-3">
                <div class="card-body">
                    <form method="post" action="/reset-password">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            <input type="password"
                                   class="form-control"
                                   id="password_confirmation"
                                   name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary btn-save">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <h1 class="display-6 text-primary">Saved Jobs</h1>
            <div class="card mb-3">
                <div class="card-body">
                @if (count($saved) === 0)
                    <div class="text-center">
                        <p class="text-secondary">No Saved Jobs</p>
                        <a class="btn btn-outline-primary btn-apply"
                           href="/jobs"
                           style="width:100px;">Search</a>
                    </div>
                @endif
                @foreach($saved as $job)
                    <p id="p-{{ $job->job_id }}">
                        <button type="button"
                                id="unsave-{{ $job->job_id }}"
                                class="btn btn-outline-primary btn-unsave btn-remove float-end">Unsave</button>
                        <a href="/jobs/{{ $job->job_id }}"
                           class="link-underline link-underline-opacity-0"
                           target="_blank">
                            {{ $job->job_title }} - {{ $job->created_at?->format('M d, Y') }}
                        </a>
                    </p>
                @endforeach
                </div>
            </div>
            <h1 class="display-6 text-primary">Posted Jobs</h1>
            <div class="card mb-3">
                <div class="card-body">
                    @if (count($posts) === 0)
                        <div class="text-center">
                            <p class="text-secondary">No Posted Jobs</p>
                            <a class="btn btn-outline-primary btn-apply"
                               href="/post" style="width:100px;">Post a Job</a>
                        </div>
                    @endif
                    @foreach($posts as $post)
                        <p>
                            <button type="button" class="btn btn-outline-danger btn-remove float-end">
                                Archive
                            </button>
                            <a href="/post/{{ $post->job_id }}"
                               class="link-underline link-underline-opacity-0"
                               target="_blank">
                                {{ $post->job_title }} - {{ $post->created_at?->format('M d, Y') }}
                            </a>
                        </p>
                    @endforeach
                </div>
            </div>
            <h1 class="display-6 text-primary">Archived Jobs</h1>
            <div class="card mb-3">
                <div class="card-body">
                @if (count($archives) === 0)
                    <div class="text-center">
                        <span class="text-secondary">No Archived Jobs</span>
                    </div>
                @endif
                @foreach($archives as $archive)
                    <p>
                        <button type="button"
                                id="unsave-{{ $archive->job_id }}"
                                class="btn btn-outline-danger btn-archive btn-remove float-end">
                            Delete
                        </button>
                        <a href="/post/{{ $archive->job_id }}"
                           class="link-underline link-underline-opacity-0"
                           target="_blank">
                            {{ $archive->job_title }} - {{ $archive->created_at?->format('M d, Y') }}
                        </a>
                    </p>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@auth
@push('body_scripts')
<script>
$(document).ready(() => {
    $('.container').on('click', '.btn-unsave', (event) => {
        console.log(event.target.id);
        let $btn = $('#'+event.target.id);
        $btn.attr('disabled', true)
        let id = event.target.id.replace('unsave-', '');
        console.log(id);
        let data = {
            id: id,
            _method: 'DELETE',
            _token: "{{ csrf_token() }}"
        };
        console.log(data)
        $.ajax({
            url: '/jobs/save',
            data: data,
            method: 'DELETE',
            success: () => {
                $btn.attr('disabled', false);
                $(`#p-${id}`).empty();
            },
            error: (response) => {
                console.log(response);
            },
        });
    });
});
</script>
@endpush
@endauth
