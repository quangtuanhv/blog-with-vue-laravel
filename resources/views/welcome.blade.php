<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/images/favicon.ico') }}"/>
    <script>
        window.Laravel = {!! json_encode([
            'appName' => config('app.name'),
            'csrfToken' => csrf_token(),
            'locale' => config('app.locale'),
            'fallbackLocale' => config('app.fallback_locale'),
            'url' => url('/'),
            'languages' => config('settings.locale'),
            
        ]) !!};
        @if (session('access_token'))
            localStorage.setItem('access_token', '{{ session('access_token') }}')
        @endif
    </script>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700|Inconsolata:400,700" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! Html::style(asset('css/app.css')) !!}
    {!! Html::style(mix('css/style.css')) !!}
</head>

<body>

    <div id="app">
        <router-view></router-view>
    </div>

    {!! Html::script(mix('js/app.js')) !!}
</body>

</html>
