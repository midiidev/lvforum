<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>

    <x-meta title="{{ $title . ' - ' . env('APP_NAME') ?? env('APP_NAME') }}"
            description="{{ $description ?? 'LVForum is an open source forum created with Laravel made to be hosted by anyone for anything. A demo of LVForum is available at https://lvforum.fireash.xyz' }}"
            url="{{ env('APP_URL') }}"
            image="/images/meta-image.png"></x-meta>

    @vite('resources/css/app.css')

    <script src="{{ env('FA_KIT') }}" crossorigin="anonymous"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
<div>
    <x-navbar />

    <div class="w-11/12 mx-auto">
        {{ $slot }}
    </div>

    <x-footer />

    @if(session()->has('error'))
        <x-flash type="error" message="{{ session('error') }}" />
    @endif
    @if(session()->has('success'))
        <x-flash type="success" message="{{ session('success') }}" />
    @endif
</div>
</body>
</html>
