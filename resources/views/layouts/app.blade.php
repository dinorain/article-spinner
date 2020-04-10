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
        <!-- ============================================================== -->
        <!-- main wrapper -->
        <!-- ============================================================== -->
        <div class="dashboard-main-wrapper">
            <!-- ============================================================== -->
            <!-- navbar -->
            <!-- ============================================================== -->
            <div class="dashboard-header">

                @include('include.navbar')

                <!-- ============================================================== -->
                <!-- wrapper  -->
                <!-- ============================================================== -->
                <div class="dashboard-wrapper">
                    <div class="container-fluid dashboard-content">
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>

        <!-- JS Scripts -->
        @include('include.script')
        @yield('js')
        @yield('js1')
        @yield('js2')

        {{-- Toastr --}}
        {!! Toastr::render() !!}
    </body>
</html>

