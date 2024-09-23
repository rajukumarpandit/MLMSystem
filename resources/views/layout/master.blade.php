<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Login')</title>
    <link rel="stylesheet" href="/resources/css/stylecss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css" />
</head>
<body>
    <!-- this section for main content -->
    @hasSection('contents')
        @yield('contents')
    @else
        <h2>Content not found!</h2>
    @endif  

    <!-- this section for write within css code -->
    @stack('styles')

    <!-- this section for write within javascript and jQuery code -->
    @stack('scripts')
</body>
</html>