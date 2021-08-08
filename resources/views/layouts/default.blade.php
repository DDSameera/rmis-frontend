<!doctype html>
<html lang="en">
<head>
    @include('layouts.inc.header')
</head>
<body>
@include('layouts.inc.navbar')
<div class="container-fluid">
    @yield('content')
    <hr>
    @include('layouts.inc.footer')
    @include('layouts.inc.scripts')
</div>


</body>
</html>