<!DOCTYPE html>
<html lang="en">
    <head>
        @include('include.head')

        <!-- CSS styles -->
        @yield('css')
        @yield('css1')
        @yield('css2')
    </head>

    <body>
        @include('include.navbar')

        @yield('content')

        <!-- JS Scripts -->
        @include('include.script')
        @yield('js')
        @yield('js1')
        @yield('js2')

        {{-- Toastr --}}
        {!! Toastr::render() !!}
    </body>
</html>

