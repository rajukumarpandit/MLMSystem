@extends('layout.main')
@extends('layout.sidebar')
@extends('layout.headerbar')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-6">
                <form action="{{route('updateuser')}}" method="post">
                    @csrf
                    <h2 class="text-center">Edit User</h2>
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="form-group">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="Enter name">
                        <span class="text-danger">@error('name'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder="Enter email">
                        <span class="text-danger">@error('email'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">State</label>
                        <select class="form-select" name="state" aria-label="Default select example">
                            <option selected>{{ucwords($user->state)}}</option>
                            <option value="up">Up</option>
                            <option value="bihar">Bihar</option>
                            <option value="delhi">Delhi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">CFM</label>
                        <select class="form-select" name="cfm" aria-label="Default select example">
                            <option selected>{{$user->cfm}}</option>
                            <option value="NULL">NULL</option>
                            <option value="CFM">CFM</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        {{-- <p class="mt-2">link : <a href="{{route('login.page')}}">login</a></p> --}}
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