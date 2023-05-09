<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('template.styles')
        @yield('styles')
        <title>{{ env('app_name') }} | @yield('publisher'): @yield('title')</title>
    </head>
    <body>
    @include('template.splash')

    <div class="wrappage">
        @include('template.header')
       @include('template.breadcrumb')
        <!-- End container -->
        @yield('content')
        @include('template.footer')
    <!-- End wrappage -->
    </div>
    @include('template.scripts')
    <script>
        $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    </script>
    @yield('scripts')
    </body>
</html>
