@section('sidebar')
<div class="sidebar">
    <div class="log">
        Hello, Friends
    </div>
    <ul class="menu">
        <li class="active">
            
            <a>
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{route('profile')}}">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
        </li>
        <li>
            <a href="{{route('myreferral')}}">
                <i class="fas fa-user"></i>
                <span>My Referral</span>
            </a>
        </li>
        <li>
            <a href="{{route('mytree')}}">
                <i class="fas fa-user"></i>
                <span>My Tree</span>
            </a>
        </li>
        <li>
            <a href="{{route('earn_history')}}"> 
                <i class="fas fa-user"></i>
                <span>History</span>
            </a>
        </li>
        <li>
            <a href="{{route('subscription')}}">
                <i class="fas fa-chart-bar"></i>
                <span>Subscription</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="fas fa-briefcase"></i>
                <span>Career</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="fas fa-question-circle"></i>
                <span>FAQ</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="fas fa-star"></i>
                <span>Testimonials</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="fas fa-cog"></i>
                <span>Setting</span>
            </a>
        </li>
        <li class="logout">
            @if (Auth::check())
                <p>{{Auth::User()->name}}</p>
            @endif
            <a href="{{route('logout')}}">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>
@endsection
@push('styles')
<style>
    *{
    margin: 0;
    padding: 0;
    outline: none;
    border: none;
    box-sizing: border-box;
    font-family: "poppins", sans-serif;
    }
    body{
        display: flex;
    }
    .sidebar{
        position: sticky;
        top: 0;
        left: 0;
        bottom: 0;
        /* width: 110px; */
        width: 240px;
        height: 100vh;
        padding: 0 1.7rem;
        overflow: hidden;
        color: #fff;
        transition: all 0.5s linear;
        background: rgba(113, 99, 186, 255);
    }
    /* .sidebar:hover{
        width: 240px;
        transition: all 0.5s;
    } */
    .log{
        height: 60px;
        padding: 16px;
    }
    .menu{
        height: 88%;
        position: relative;
        list-style: none;
        padding: 0;
    }
    .menu li{
        padding: 1rem;
        margin: 8px 0;
        border-radius: 8px;
        transition: all 0.5s ease-in-out;
    }
    .menu li:hover, .active{
        background: #e0e0e058;
    }
    .menu a{
        color: #fff;
        font-size: 14px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }
    .menu a span{
        overflow: hidden;
    }
    .menu a i{
        font-size: 1.2rem;
    }
    .logout{
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
    }
</style>
@endpush