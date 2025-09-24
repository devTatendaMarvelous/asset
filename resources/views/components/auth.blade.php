<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-topbar="light" data-sidebar-image="none">

<head>
    <meta charset="utf-8"/>
    <title> | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Schools Management System" name="description"/>
    <meta content="SMS" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.png')}}">
    <x-head-css/>
</head>
<body>
@include('sweetalert::alert')
    {{$slot}}
    <x-vendor-scripts/>
</body>
</html>
