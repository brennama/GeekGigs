@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="container" style="max-width: 600px;">
    <div class="row mb-3">
        <h1 class="display-6 text-primary">Forgot Password</h1>
    </div>
    <div class="row">
        <div class="col">
            <form method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <button type="submit" class="btn btn-primary">Send Password Reset Email</button>
            </form>
        </div>
    </div>
</div>
@endsection
