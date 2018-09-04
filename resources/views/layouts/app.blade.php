<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Panel de Control') | {{ config('app.name', 'Skolan') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        @include('partials.nav')
        
        {{--<main class="py-4">
            @yield('content')
        </main>--}}
        <div class="container-fluid">
            <div class="row m-t-1">
                <aside class="col-md-2 aside sidebar" role="complementary">
                    @include('layouts.aside')
                </aside>
                <main class="col-md-10 offset-md-2 main" role="main">
                    @include('flash::message')
                    @include('partials.errors')
                    <h1 class="page-header">@yield('title', 'Panel de Control')</h1>
                    <div class="content">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('js')
</body>
</html>
