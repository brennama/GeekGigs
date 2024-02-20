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
                    <p id="s-{{ $job->job_id }}">
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
                        <p id="p-{{ $post->job_id }}">
                            <button type="button"
                                    id="archive-{{ $post->job_id }}"
                                    data-title="{{ $post->job_title }}"
                                    class="btn btn-outline-danger btn-remove btn-archive float-end">
                                Archive
                            </button>
                            <a href="/post/{{ $post->job_id }}"
                               class="btn btn-outline-primary btn-apply float-end me-3"
                               target="_blank">Edit</a>
                            <a href="/jobs/{{ $post->job_id }}"
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
                        <div class="text-center" id="no-archived-jobs">
                            <span class="text-secondary">No Archived Jobs</span>
                        </div>
                    @endif
                    <div id="archive-list">
                    @foreach($archives as $archive)
                        <p id="a-{{ $archive->job_id }}">
    {{--                        <button type="button"--}}
    {{--                                class="btn btn-outline-danger btn-remove float-end">--}}
    {{--                            Delete--}}
    {{--                        </button>--}}
                            <a href="/post/{{ $archive->job_id }}"
                               class="text-secondary link-underline link-underline-opacity-0"
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
</div>
@endsection

@auth
@push('body_scripts')
<script>
$(document).ready(() => {
    const container = $('.container');

    container.on('click', '.btn-unsave', (event) => {
        let $unsaveBtn = $('#'+event.target.id);
        $unsaveBtn.attr('disabled', true)
        let id = event.target.id.replace('unsave-', '');
        let data = {
            id: id,
            _method: 'DELETE',
            _token: "{{ csrf_token() }}"
        };
        $.ajax({
            url: '/jobs/save',
            data: data,
            method: 'DELETE',
            success: () => {
                $unsaveBtn.attr('disabled', false);
                $(`#s-${id}`).empty();
            },
            error: (response) => {
                console.log(response);
            },
        });
    });

    container.on('click', '.btn-archive', (event) => {
        let $archiveBtn = $('#'+event.target.id);
        $archiveBtn.attr('disabled', true)
        let id = event.target.id.replace('archive-', '');
        let data = {
            id: id,
            title: $archiveBtn.attr('data-title'),
            _method: 'DELETE',
            _token: "{{ csrf_token() }}"
        };
        let createdAt = '{{ date('M d, Y') }}';
        $.ajax({
            url: '/jobs/archive',
            data: data,
            method: 'DELETE',
            success: (r) => {
                console.log(r);
                $archiveBtn.attr('disabled', false);
                $(`#p-${id}`).empty();
                $(`#no-archived-jobs`).empty();
                $(`#archive-list`).append(`
                    <p id="a-${id}">
                        <a href="/post/${id}"
                           class="text-secondary link-underline link-underline-opacity-0"
                           target="_blank">${$archiveBtn.attr('data-title')} - ${createdAt}</a>
                    </p>`);
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
