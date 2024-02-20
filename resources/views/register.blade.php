@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
<div class="container" style="max-width: 600px;">
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <span>{{ $error }}</span>@if (!$loop->last)<br>@endif
            @endforeach
        </div>
    @endif
    <div class="row mb-3">
        <h1 class="display-6 text-primary">Register with GeekGigs</h1>
    </div>
    <div class="row">
        <div class="col">
            <form method="post" id="register-form" action="{{ request()->fullUrl() }}">
                @csrf
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text"
                           class="form-control"
                           id="first_name"
                           name="first_name"
                           value="{{ old('first_name') }}">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text"
                           class="form-control"
                           id="last_name"
                           name="last_name"
                           value="{{ old('last_name') }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email"
                           class="form-control"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">
                        <small>We'll never share your email with anyone else.</small>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Password Confirmation</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <button type="submit"
                        class="btn btn-primary g-recaptcha"
                        data-sitekey="6LdEQ2YpAAAAABW0Xz6CDML_GJva5LY7i6Eex9P_"
                        data-callback='onSubmit'
                        data-action='submit'>Register</button>
            </form>
        </div>
    </div>
</div>
@endsection
