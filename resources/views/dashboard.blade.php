@extends('layout.main')
@extends('layout.sidebar')
@extends('layout.headerbar')
@section('title')
    Dashboard
@endsection

@section('content')
    
    <div class="container">
        <h2>Downline</h2>
        {{-- <div class="d-flex gap-2">
            {{-- <div class="card" style="width: 100rem;">
                <p>{{$userdata}}</p>
            </div> --}}
            {{-- <div class="card" style="width: 25rem;">
                <h5 class="card-title">User Details</h5>
                
                @foreach ($userdata as $data)
                <ul class="card-text">
                    
                    <li>User Id : {{$data->id}}</li>
                    <li>Name : {{$data->name}}</li>
                    <li>Email : {{$data->email}}</li>
                    <li>Referral by : {{$data->referrer_id}} ?? 0</li>
                    <li>Total Balance : {{$data->balance}}</li>
                    <h5 class="card-title">Your Earnings</h5>
                    <ul class="card-text">
                        @foreach($data->referrals as $referral)
                            <li>ID : {{$referral->id}}</li>
                            <li>Name : {{$referral->name}}</li>
                            <li>Email : {{$referral->email}}</li>
                            <li>Balance : {{$referral->balance}}</li>
                            <li>Referred By : {{$referral->referrer_id}}</li>
                            <li>Earned on {{ $referral->created_at->format('d M Y') }}</li>
                        @endforeach
                    </ul>
                        <h5 class="card-title">Referred</h5>
                        <ul>
                            
                            @foreach($data->triggeredReferralRewards as $referred)
                                
                            <li>User ID : {{$referred->user_id}}</li>
                            <li>Referred By : {{$referred->referrer_id}}</li>
                            <li>Amount : {{$referred->amount}}</li>
                            <li>Referred on {{ $referred->created_at->format('d M Y') }}</li>
                            @endforeach
                        </ul>
                </ul>
                @endforeach
                
            </div> --}}
        </div>
    {{-- <div class="container">
        <h2>Downline</h2>
        <div class="d-flex gap-2">
            <div class="card" style="width: 25rem;">
                <h5 class="card-title">User Details</h5>
                @foreach ($userdata as $data)
                <ul class="card-text">
                    <li>User Id : {{$data->id}}</li>
                    <li>Name : {{$data->name}}</li>
                    <li>Email : {{$data->email}}</li>
                    <li>Referral Code : {{$data->referral_id}}</li>
                    <p class="card-text">Total Earnings: ${{ $data->earnings->sum('amount') }}</p>
                    <h5 class="card-title">Your Earnings</h5>
                    <ul class="card-text">
                        @foreach($data->earnings as $earning)
                            <li>{{ $earning->amount }} earned on {{ $earning->created_at->format('d M Y') }}</li>
                        @endforeach
                    </ul>
                        <h5 class="card-title">Referred</h5>
                        <ul>
                            @foreach($data->referred as $referral)
                            <li>{{ $referral->user_id }} referred on {{ $referral->created_at->format('d M Y') }}</li>
                            @endforeach
                        </ul>
                </ul>
                @endforeach
            </div>
        </div> --}}
        {{-- <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title">User Details</h5>
                <ul class="card-text">
                    <li>User Id : {{$userdata->id}}</li>
                    <li>Name : {{$userdata->name}}</li>
                    <li>Email : {{$userdata->email}}</li>
                    <li>Referral Code : {{$userdata->referral_id}}</li>
                </ul>
            <p class="card-text">Total Earnings: ${{ $userdata->earnings->sum('amount') }}</p>
            </div>
        </div>
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title">Your Earnings</h5>
                <ul class="card-text">
                @foreach($userdata->earnings as $earning)
                    <li>{{ $earning->amount }} earned on {{ $earning->created_at->format('d M Y') }}</li>
                @endforeach
                </ul>
            <p class="card-text">Total Earnings: ${{ $userdata->earnings->sum('amount') }}</p>
            </div>
        </div>
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title">Referred</h5>
                
                <ul class="card-text">
                    <li>User Id : {{$userdata->id}}</li>
                        <ul>
                            @foreach($userdata->referred as $referral)
                            <li>{{ $referral->user_id }} referred on {{ $referral->created_at->format('d M Y') }}</li>
                            @endforeach
                        </ul>
                </ul>
                <p class="card-text">Total Referral Users: {{ count($userdata->referred)}}</p>
            </div>
        </div> --}}
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