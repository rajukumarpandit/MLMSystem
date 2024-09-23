<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'login')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>
    <!-- Yield section for sidebar -->
    @yield('sidebar')

    <!-- this section for header bar -->
    @yield('headerbar')

    <!-- this section for write within css code -->
    @stack('styles')

    <!-- this section for write within javascript and jQuery code -->
    @stack('scripts')
</body>
</html>