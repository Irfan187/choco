<!doctype html>
<html lang="en">

<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="" name="description">
    <meta content="" name="author">
    <meta name="keywords"
        content="dashboard template, bootstrap admin template, bootstrap admin template, admin template, bootstrap dashboard, html template, css templates, bootstrap form template, bootstrap 4 templates, bootstrap dashboard template, admin dashboard template, html dashboard template, bootstrap grid template, html admin template, bootstrap 4 admin template, bootstrap 4 dashboard, bootstrap admin, admin dashboard, html and css templates, themeforest html, themeforest html templates, template html5 bootstrap" />

    <!-- Favicon -->
    <link rel="icon" href="{{asset('admin/assets/images/brand/favicon.ico')}}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin/assets/images/brand/favicon.ico')}}" />

    <!-- bootstrap -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <!-- Title -->
    <title>Choco</title>

    @include('admin.partials.basic.head')
    @yield('css')
</head>

<body class="app sidebar-mini">

    <!--Loader-->
    <div id="global-loader">
        <img src="{{asset('admin/assets/images/loader.svg')}}" class="loader-img" alt="">
    </div>
    <!--/Loader-->
    <!--Page-->
    <div class="page">
        <div class="page-main">
            <!--App-Header-->
            @include('admin.partials.basic.nav')
            <!--/App-Header-->
            <!-- Sidebar menu-->
            @include('admin.partials.sidebar')
            <!-- /Sidebar menu-->
            <!--App-Content-->
            <div class="app-content">
                <div class="side-app">
                    <div class="page-header">
                        <h4 class="page-title">Dashboard </h4>
                        {{-- <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard </li>
                        </ol> --}}
                    </div>
                    {{-- @include('admin.partials.basic.breadcrum') --}}
                    <!--/Page-Header-->
                    @yield('content')
                    <!--Footer-->
                    @include('admin.partials.footer')
                    <!--/Footer-->
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.basic.script')
  
    @yield('script')
</body>

</html>
