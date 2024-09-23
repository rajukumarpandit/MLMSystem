@extends('layout.master')
@section('title')
    login
@endsection

@section('contents')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-6">
                
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <h2 class="text-center">Login Panel</h2>
                    <div class="form-group">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                        <span class="text-danger">@error('email'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                        <span class="text-danger">@error('password'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <p class="mt-2">link : <a href="{{route('register.page')}}">register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--alert message-->
    <div class="position-relative" id="success">
        <div class="position-absolute bottom-0 end-0" >
            @if (Session::has('success')) <div class="alert alert-success" >{{Session::get('success')}}</div>@endif
        </div>
    </div>
    <!--alert message-->
    <div class="position-relative" id="error">
        <div class="position-absolute bottom-0 end-0" >
            @if (Session::has('error'))<div class="alert alert-danger">{{ Session::get('error')}}</div>@endif
        </div>
    </div>
@endsection
@push('scripts')
<script src="/resources/js/hello.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            setTimeout(function() { 
                $('#success').hide();
                $('#erro').hide();
            },3000);

        });
        

    </script>
@endpush