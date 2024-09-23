@extends('layout.main')
@extends('layout.sidebar')
@extends('layout.headerbar')
@section('title')
    Dashboard
@endsection

@section('content')
        <h2>My History</h2>
    <div class="row mt-3">
        <div class="col">
            <table class="table table-striped table-hover table-rounded mt-2" style="background-color: #e3f2fd;">
                <thead class="table-primary">
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">user Id</th>
                    <th scope="col">Email</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                @forelse ($histories as $history)
                    <tr>
                        
                        <td>{{$history->created_at->format('d M Y')}}</td>
                        <td>{{$history->user_id}}</td>
                        <td>{{$history->user->email}}</td>
                        <td><span class="amount">+ {{$history->amount}}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td>not found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
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
@push('styles')
    <style>
        .amount{
            color: rgb(13, 248, 13);
            font-size: 16px;
            font-weight: 1000;
            padding-right: 5px; 
        }
        td{
            font-weight: bold;
        }
    </style>
@endpush