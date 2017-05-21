<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', app_name())</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        @yield('meta')

        {{--@yield('before-style')--}}
        {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/Backstage.css') }}"/>--}}
        {{--@yield('after-style')--}}

        @yield('style')
    </head>

    <body>

        @include('includes.messages')
        @include('backend.includes.header')
        @include('backend.includes.menu)

        @yield('content')

        @yield('before-script')
        <script type="text/javascript" src="{{ asset('js/jquery-2.1.0.js') }}"></script>
        @yield('after-script')
        @yield('message-script')
    </body>
</html>