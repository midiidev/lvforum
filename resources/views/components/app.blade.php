<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @isset($title)
    <title>{{ $title }} - {{ env('APP_NAME') }}</title>
    @else
    <title>{{ env('APP_NAME') }}</title>
    @endisset

    @vite('resources/css/app.css')

    <script src="{{ env('FA_KIT') }}" crossorigin="anonymous"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
<div class="bg-slate-900 text-slate-200" style="min-height: 100vh">
    <x-navbar />

    {{ $slot }}

    <x-footer />

    @if(session()->has('error'))
        <x-flash colour="red-600" text="{{ session('error') }}" />
    @endif
    @if(session()->has('success'))
    <x-flash colour="green-600" text="{{ session('success') }}" />
    @endif
</div>
</body>
</html>
