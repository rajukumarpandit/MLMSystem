@extends('layout.master')
@section('title')
    Registration
@endsection

@section('contents')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-6">
                <form action="{{route('register')}}" method="post">
                    @csrf
                    <h2 class="text-center">Register Panel</h2>
                    <div class="form-group">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter name">
                        <span class="text-danger">@error('name'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                        <span class="text-danger">@error('email'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">State</label>
                        <select class="form-select" name="state">
                            <option value="NULL">--Select State--</option>
                            <option value="up">Up</option>
                            <option value="bihar">Bihar</option>
                            <option value="delhi">Delhi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Referral ID</label>
                        <input type="text" name="referral_id" class="form-control" placeholder="Enter referral id (optional)">
                        <span class="text-danger">@error('referral_id'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                        <span class="text-danger">@error('password'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <p class="mt-2">link : <a href="{{route('login.page')}}">login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="position-relative" id="error">
        <div class="position-absolute bottom-0 end-0" >
            @if (Session::has('error'))<div class="alert alert-danger">{{ Session::get('error')}}</div>@endif
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            setTimeout(function() { 
                $('#error').hide();
            },3000);

        });
        

    </script>
@endpush