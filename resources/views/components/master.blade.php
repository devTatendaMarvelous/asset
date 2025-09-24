<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
    <meta charset="utf-8"/>
    <title>  {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Schools Management System" name="description"/>
    <meta content="SMS" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="https://elearning.msu.ac.zw/assets/images/logo.png">
    <x-head-css/>

    <style>
        #scroll-horizontal_info,#scroll-horizontal_filter>label{
            display: none!important;
        }
    </style>
</head>
<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <x-topbar/>
       <x-sidebar/>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @include('sweetalert::alert')
                    {{$slot}}
                </div>
                <!-- container-fluid -->
            </div>

            <!-- End Page-content -->
            <x-footer/>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
   <x-vendor-scripts/>
</body>

</html>
