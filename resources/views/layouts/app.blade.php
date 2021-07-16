<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Blog') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    <script>
      window.default_locale = "{{ app()->getLocale() }}";
      window.fallback_locale = "{{ app()->getLocale() }}";
    </script>
</head>
<body>
<div id="app">
    @include('includes.header')
    @include('includes.nav_bar')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <h4>Категории блога</h4>
                @include('layouts.part.categories',['parent'=> 1])
            </div>

            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>
        @include('includes.footer')
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
