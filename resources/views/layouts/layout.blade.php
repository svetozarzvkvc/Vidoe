<!DOCTYPE html>
<html lang="en">
@include('fixed.client.head')
<body id="page-top">
@include('fixed.client.navigation')
<div id="wrapper">
    @include('partials.sidebar')
    @yield('content')
    @include('fixed.client.footer')
</div>
@include('fixed.client.scripts')
</body>
</html>
