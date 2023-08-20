<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials._css')
    @yield('stylesheet')
</head>
<body>
    <div class="container-scroller">
        @include('partials._sidebar')
        @include('partials._header')
        @yield('body')
        @include('partials._footer')
    </div>
    </div>
    </div>
    @include('partials._script')
</body>
</html>
