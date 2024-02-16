@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="container" style="max-width: 600px;">
    <div class="row mb-3">
        <h1 class="display-6 text-primary">Reset Password</h1>
    </div>
    <div class="row">
        <div class="col">
            <form method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Password Confirmation</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <input type="hidden" name="token" value="{{ $token }}">
                <button type="submit" class="btn btn-primary">Send Password Reset Email</button>
            </form>
        </div>
    </div>
</div>
@endsection
