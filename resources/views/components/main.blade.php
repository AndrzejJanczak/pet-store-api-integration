<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if ((file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>
    {{$slot}}
    @php
        $locale = app()->getLocale();
    @endphp

    <footer class="flex flex-col items-center py-4 bg-gray-900 text-gray-300">
        <div class="mb-2 text-center">
            @if($locale === 'pl')
                <p class="text-xl">Wybierz wersję językową:</p>
                <p class="text-sm">Choose your preferred language version:</p>
            @else
                <p class="text-xl">Choose your preferred language version:</p>
                <p class="text-sm">Wybierz wersję językową:</p>
            @endif
        </div>

        <div class="flex space-x-4 text-3xl">
            <a href="{{ route('lang.switch', ['langIso' => 'pl']) }}"
               class="{{ $locale == 'pl' ?'opacity-100' :'opacity-50 hover:opacity-100' }}"
               title="Polski">
                🇵🇱
            </a>

            <a href="{{ route('lang.switch', ['langIso' => 'en']) }}"
               class="{{ $locale == 'en' ?'opacity-100' :'opacity-50 hover:opacity-100' }}"
               title="English">
                🇬🇧
            </a>
        </div>
    </footer>
</body>
</html>
