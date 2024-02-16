@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container" style="max-width: 600px;">
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <span>{{ $error }}</span>@if (!$loop->last)<br>@endif
            @endforeach
        </div>
    @endif
    <div class="row">
        <div class="col">
            <h1 class="display-6 text-primary">Login</h1>
            <form method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
                    <div id="passwordHelp" class="form-text">
                        <small class="me-3"><a href="/password-reset">Forgot Password</a></small>
                        <small><a href="/register">Sign Up</a></small>
                    </div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
