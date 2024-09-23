@extends('layout.main')
@extends('layout.sidebar')
@extends('layout.headerbar')
@section('title')
    Subscription
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-6">
                <div class="card" style="width: 25rem;">
                    <div class="card-body">
                      <h5 class="card-title">Subscription Plan</h5>
                      <form action="{{route('subscriptions')}}" method="post">
                        @csrf
                        {{-- <p>{{ $userid}}</p> --}}
                            {{-- <input type="hidden" name="user_id" value="{{$userid}}"> --}}
                            <div class="form-group">
                                <label for="" class="form-label">Plan</label>
                                <select class="form-select" name="plan_name" aria-label="Default select example">
                                    <option selected>--Select plan--</option>
                                    <option value="premium">Premium</option>
                                    <option value="simple">Simple</option>
                                </select>
                                <span class="text-danger">@error('plan_name'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Plan Price</label>
                                <select class="form-select" name="car_limit" aria-label="Default select example">
                                    <option selected>--Select plan--</option>
                                    <option value="5000">$5000</option>
                                    <option value="2000">$2000</option>
                                </select>
                                <span class="text-danger">@error('card_limit'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control">
                                <span class="text-danger">@error('date'){{$message}}@enderror</span>
                            </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">Book Plan</button>
                            
                        </div>
                    </form>
                    </div>
                  </div>
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