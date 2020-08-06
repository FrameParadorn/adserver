<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet" >
    @yield('css')
</head>
<body 
    {!! !empty($hasBackground) ? 'style="background: url(\'images/bg.jpg\'); background-size: cover;"' : '' !!}
    class="mb-5"
    >
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
    @yield('js')
</body>
</html>
