@extends('layout.main')
@extends('layout.sidebar')
@extends('layout.headerbar')
@section('title')
    Dashboard
@endsection

@section('content')
    
    <div class="container">
        <h2>My Tree</h2>
        
        <div class="tree">
            <ul>
                <li>
                    <!-- Root user -->
                    <div class="person">
                        {{-- <img src="https://via.placeholder.com/50" alt="Person"> --}}
                        <p>{{ ucwords($user->name) }} ({{ $user->cfm?? ' ' }})</p>
                    </div>
                    
                    <!-- Render the tree recursively -->
                    <ul>
                        @foreach ($members as $member)
                            @include('treeitem', ['member' => $member])
                        @endforeach
                    </ul>
                    
                </li>
            </ul>
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
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f5f5f5;
}

.tree ul {
  padding-top: 20px;
  position: relative;
  transition: all 0.5s;
}

.tree ul ul::before {
  content: '';
  position: absolute;
  top: 0;
  left: 50%;
  border-left: 2px solid #ccc;
  width: 0;
  height: 20px;
}

.tree ul ul ul::before {
  top: 0;
  left: 50%;
}

.tree li {
  float: left;
  text-align: center;
  list-style-type: none;
  position: relative;
  padding: 20px 5px 0 5px;
  transition: all 0.5s;
}

.tree li::before, .tree li::after {
  content: '';
  position: absolute;
  top: 0;
  right: 50%;
  border-top: 2px solid #ccc;
  width: 50%;
  height: 20px;
}

.tree li::after {
  right: auto;
  left: 50%;
  border-left: 2px solid #ccc;
}

.tree li:only-child::after, .tree li:only-child::before {
  display: none;
}

.tree li:only-child {
  padding-top: 0;
}

.tree li:first-child::before, .tree li:last-child::after {
  border: 0;
}

.tree li:last-child::before {
  border-right: 2px solid #ccc;
}

.tree li:first-child::after {
  border-left: 2px solid #ccc;
}

.person {
  border: 1px solid #ccc;
  display: inline-block;
  padding: 10px;
  text-align: center;
  background-color: #fff;
  border-radius: 5px;
  width: 80px;
  height: 50px;
}

.person img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}

.person p {
  margin-top: 5px;
  font-size: 12px;
  color: #333;
}
a{
  text-decoration: none
}

</style>
@endpush