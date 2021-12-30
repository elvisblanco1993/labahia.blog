<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{asset('favicon.svg')}}" type="image/svg">

        @if (request()->routeIs('articles.view'))
            <meta property="og:url"          content="{{ url()->current() }}" />
            <meta property="og:type"         content="article" />
            <meta property="og:title"        content="{{ $article->title }}" />
            <meta property="og:description"  content="{{Str::limit(strip_tags($article->body), 50)}}" />
            <meta property="og:image"        content="{{ url('/storage/photos/' . $article->image) }}" />
        @endif

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="bg-white dark:bg-gray-900">
        <div class="font-sans dark:bg-gray-900 text-gray-900 dark:text-gray-200 antialiased relative min-h-screen">
            {{ $slot }}
        </div>
        @include('layouts.footer')
        @stack('modals')
        @livewireScripts
    </body>
</html>
