<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8" />
    <title>Metronic | Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" /> 
    @include('partials._head')
    @yield('stylesheets')
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

    @include('partials._navbar')

    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->

    <!-- BEGIN CONTAINER -->
    <div class="page-container">

    @include('partials._sidebar')

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY-->
            <div class="page-content" style="min-height:1015px">

                @yield('content')

            </div>
            <!-- END CONTENT BODY-->
        </div>
        <!-- END CONTENT -->

        <!-- BEGIN QUICK SIDEBAR -->
        <a href="#" class="page-quick-sidebar-toggler">
            <i class="icon-login"></i>
        </a>
        <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
            <div class="page-quick-sidebar">
                
            </div>
        </div>
        <!-- END QUICK SIDEBAR -->

    </div>
    <!-- END CONTAINER -->

    @include('partials._footer')

    @include('partials._javascript')

    @yield('scripts')

</body>

</html>