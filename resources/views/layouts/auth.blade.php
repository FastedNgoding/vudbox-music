<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VudBox - @yield('title', 'Welcome')</title>
    <link rel="shortcut icon" href="{{ url('logo.png') }}" type="image/x-icon">
    @vite('resources/js/app.js')
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
</head>

<body class="bg-primary text-foreground min-vh-100 d-flex align-items-center justify-content-center">
    <div class="container py-4 py-md-5">
        @yield('content')
    </div>
    
    @yield('scripts')
</body>

</html>
