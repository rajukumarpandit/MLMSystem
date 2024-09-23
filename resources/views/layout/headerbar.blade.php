@section('headerbar')
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg rounded" style="background-color: #e3f2fd;">
        <div class="container-fluid">
        <a class="navbar-brand" href="#"><h1>Dashboard</h1></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="d-flex">
                <p class="pt-2">Welcome , {{Auth::User()->email}}</p>
            </div>
        </div>
    </nav>
    @hasSection('content')
        @yield('content')
    @else
        <h2>Content not found!</h2>
    @endif  
</div>
@endsection