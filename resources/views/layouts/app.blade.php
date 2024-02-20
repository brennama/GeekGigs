<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GeekGigs - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    @stack('styles')
    <style>
        .btn-apply, .btn-remove, .btn-save, .btn-view {
            --bs-btn-padding-y: .25rem;
            --bs-btn-padding-x: .5rem;
            --bs-btn-font-size: .75rem;
            width: 80px;
        }
    </style>
    @stack('head_scripts')
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary mb-5" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/img/logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            GeekGigs
        </a>
        <button class="navbar-toggler"
                type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent"
                aria-controls="navbarContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
{{--                @auth--}}
{{--                    @if (Illuminate\Support\Facades\Auth::user()->isAdmin)--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="/admin">Admin</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                @endauth--}}
                <li class="nav-item">
                    <a class="nav-link" href="/jobs">Search Jobs</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="/post">Post a Job</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="/profile">{{ ucfirst(Illuminate\Support\Facades\Auth::user()->first_name) }}'s Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
                @endauth
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@yield('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
@stack('body_scripts')
</body>
</html>
