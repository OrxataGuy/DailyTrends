<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        @include('template.styles')
        @yield('styles')
        <title>{{ env('app_name') }}@hasSection('title') | @yield('title') @endif</title>
    </head>
    <body class="bg">
        @include('template.splash')

    <!-- End pushmenu -->
    <div class="wrappage">
        @include('template.header')
        @yield('content')
        @include('template.footer')

    <!-- End wrappage -->
    </div>
    @include('template.scripts')
    @yield('scripts')
    </body>
</html>
