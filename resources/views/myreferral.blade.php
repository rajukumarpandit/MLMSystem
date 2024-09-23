@extends('layout.main')
@extends('layout.sidebar')
@extends('layout.headerbar')
@section('title')
    Dashboard
@endsection

@section('content')
        <h2>My Referral</h2>
    <div class="row mt-3">
        <div class="col">
            <table class="table table-striped table-hover table-rounded mt-2" style="background-color: #e3f2fd;">
                <thead class="table-primary">
                  <tr>
                    <th scope="col">user Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Referred By</th>
                    <th scope="col">Date</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                @forelse ($myreferral as $refer)
                    <tr>
                        <td>{{$refer->id}}</td>
                        <td>{{$refer->name}}</td>
                        <td>{{$refer->email}}</td>
                        <td>{{Auth::User()->email}}</td>
                        <td>{{$refer->created_at->format('d M Y')}}</td>
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