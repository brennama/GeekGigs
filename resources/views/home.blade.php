@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<style>
    .btn-home {width:250px;}
</style>
@endpush

@section('content')
    <div class="container" style="max-width:600px; margin-top:20%;">
        <div class="row mb-3">
            <div class="col text-center">
                <h1 class="display-6 text-primary">What Would You Like To Do?</h1>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <a href="/jobs" class="btn btn-lg btn-outline-primary btn-home">Search for Jobs</a>
                <a href="/post" class="btn btn-lg btn-outline-primary btn-home">Post a Job</a>
            </div>
        </div>
    </div>
@endsection
