<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? 'My-App'}}</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    @yield('head')
</head>
<body>
    @include('layout.navigation')
    <div class="py-4">
        @include('alert')
        @yield('content')
    </div>
</body>
</html>