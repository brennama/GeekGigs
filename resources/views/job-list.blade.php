@extends('layouts.app')

@section('title', 'Job Search')

@section('content')
    @foreach ($jobs as $job)
        <p>RENDER OUR JOB HTML</p>
    @endforeach
@endsection

