<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MY BLOG')</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>

    <!-- Scripts -->
    {{--<script src="{{ mix('js/app.js', 'build') }}" defer></script>--}}

    <!-- Styles -->
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
    @yield('style')

    <style>
        .navbar-badge {
            top: -2px;
            right: -4px;
        }

        a.nav-link .image img {
            width: 22px;
            height: 22px;
        }

        .dropdown-menu .user-header {
            background-color: #17a2b8;
            padding: 10px;
            text-align: center;
        }

        .dropdown-menu .user-header p {
            color: white;
        }
    </style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

    @include('layouts.backend.navbar')

    @include('layouts.backend.sidebar')

    @yield('content')

    @include('layouts.backend.footer')


</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js', 'build') }}"></script>

@yield('script')

</body>
</html>




