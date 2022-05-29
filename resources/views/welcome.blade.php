<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tweety</title>
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="flex h-screen items-center justify-center">
            <div>
                <div class="text-6xl text-gray-600">
                    Tweety
                </div>
                <div class="flex font-bold @auth justify-center @else justify-around @endauth text-gray-500">
                    @auth
                        <a href="{{ route('home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </body>
</html>
