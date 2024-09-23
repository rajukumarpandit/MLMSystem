@extends('layout.main')
@extends('layout.sidebar')
@extends('layout.headerbar')
@section('title')
    Dashboard
@endsection

@section('content')
    
    <div class="container">
        <h2>User Profile</h2>
        {{-- <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title">User Details</h5>
                <ul class="card-text">
                    <li>User Id : {{$user->id}}</li>
                    <li>Name : {{$user->name}}</li>
                    <li>Email : {{$user->email}}</li>
                    <li>Total Balance : {{$user->balance}}</li>
                    <li>Referral By : {{ $user->referrer_id ?? 'None' }}</li>
                    <li>Share Link  -> <a href="{{$user->referral_link}}">Share</a></li>
                </ul>
            </div>
        </div> --}}
        <div class="card" style="width: 25rem;">
            <div class="card-body ">
              <h5 class="card-title">Name : {{ucwords($user->name)}}</h5>
              <p class="card-text">User Id : {{$user->id}}</p>
              <p class="card-text">Email : {{$user->email}}</p>
              <p class="card-text">Total Balance : {{$user->balance}}</p>
              <p class="card-text">Referral By : {{ $user->referrer_id ?? 'None' }}</p>
              <div class="d-flex p-2">
                <a href="#" class="btn btn-primary m-2">Update</a> 
                <a href="#" class="btn btn-danger m-2">Delete</a>
                <a href="{{$user->referral_link}}" class="btn btn-info m-2">Share</a>
              </div>
            </div>
          </div>
    </div>

    
    <!--alert message-->
    <div class="position-relative" id="success">
        <div class="position-absolute bottom-0 end-0" >
            @if (Session::has('success')) <div class="alert alert-success" >{{Session::get('success')}}</div>@endif
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            setTimeout(function() { 
                $('#success').hide();
            },3000);

        });
        

    </script>
@endpush