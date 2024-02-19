@extends('layouts.app')

@section('title', 'Admin')

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
                <h1 class="display-6 text-primary">Geek Gigs Administrative Panel</h1>

            </div>
        </div>
    </div>
@endsection
