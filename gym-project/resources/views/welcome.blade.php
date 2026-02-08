<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
<h1 class="text-gray-700 dark:text-gray-100 text-8xl mb-6">Gym App</h1>
@if(Route::has("login"))
    @auth()
        <x-link-button href="{{ route('dashboard') }}">Dashboard</x-link-button>
    @else

        <x-link-button href="{{route('login')}}">Login</x-link-button>
    @endauth
@endif
</body>
</html>
