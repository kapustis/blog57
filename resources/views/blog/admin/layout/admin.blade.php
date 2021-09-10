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
    <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
    <script>
      window.default_locale = "{{ app()->getLocale() }}";
      window.fallback_locale = "{{ app()->getLocale() }}";
      window.Laravel = {!! json_encode(['signedIn' => Auth::check(),'user' => Auth::user()]) !!};
    </script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
    <div id="app">
        @include('blog.admin.includes.header')

        @include('blog.admin.includes.alerts')

        @yield('content')

        @include('includes.footer')
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
