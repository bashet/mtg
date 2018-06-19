<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.header')
</head>
<body>
    <div id="app">
        @include('partials.nav')
        {{--<nav aria-label="breadcrumb">--}}
            {{--<ol class="breadcrumb pl-5">--}}
                {{--You are here : <li class="breadcrumb-item active" aria-current="page"> Home</li>--}}
            {{--</ol>--}}
        {{--</nav>--}}

        <main class="py-4">

            <div class="container">@include('flash::message')</div>
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    @include('partials.footer')
</body>
</html>
