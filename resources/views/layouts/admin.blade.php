<!DOCTYPE html>
<html>
<head>
    @include('fixed.admin.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('fixed.admin.nav')
    @include('fixed.admin.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                @yield('contentHeader')
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>
    @include('fixed.admin.footer')
</div>
@include('fixed.admin.scripts')
</body>
</html>
