<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-topography bg-slate-700 text-zinc-300 font-sans antialiased">
        <main class="mx-auto my-10 max-w-2xl px-2">
            @yield('content')
        </main>
    </body>
</html>
