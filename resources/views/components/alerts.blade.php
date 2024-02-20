@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <span>{!! $error !!}</span>@if (!$loop->last)<br>@endif
        @endforeach
    </div>
@endif
@session('status')
<div class="alert alert-success">
    <span>{!! $value !!}</span>
</div>
@endsession
