<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin panel</title>
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

        @yield('content')

{{--        @include('includes.footer')--}}
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
