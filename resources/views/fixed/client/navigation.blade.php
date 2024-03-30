@php
    use Illuminate\Support\Facades\Auth as Auth;
@endphp
<nav class="navbar navbar-expand navbar-light bg-white static-top osahan-nav sticky-top">
    &nbsp;&nbsp;
    <button class="btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button> &nbsp;&nbsp;
    <a class="navbar-brand mr-1" href="{{route('home')}}"><img class="img-fluid" alt="logo" src="{{asset('assets/img/logo.png')}}"></a>

    <form id="search-form" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-5 my-2 my-md-0 osahan-navbar-search">
        <div class="input-group">
            <input id="search-video-input" type="text" class="form-control search-video-input" placeholder="Search for...">
            <div class="input-group-append">
                <button onclick="submit" id="search-video-button" class="btn btn-light videoProba" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <ul class="navbar-nav ml-auto ml-md-0 osahan-right-navbar">
        <li class="nav-item mx-1">
            <a class="nav-link" href="{{route('videos.create')}}">
                <i class="fas fa-plus-circle fa-fw"></i>
                Upload Video
            </a>
        </li>

        <li class="nav-item dropdown no-arrow osahan-right-navbar-user">
            <a class="nav-link dropdown-toggle user-dropdown-link" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                @if(Auth::check())
                    <img alt="Avatar" src="{{ asset('assets/img/' . Auth::user()->avatar) }}">&nbsp;&nbsp;
                    {{Auth::user()->username}}
                @endif
            </a>
            @if(Auth::check())

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{route('dashboard.show',["id"=>Auth::user()->id])}}"><i class="fas fa-fw fa-user-circle"></i> &nbsp; My
                        Account</a>
                    <a class="dropdown-item" href="{{route('subscriptions.show',["id"=>Auth::user()->id])}}"><i class="fas fa-fw fa-video"></i> &nbsp;
                        Subscriptions</a>
                    <a class="dropdown-item" href="{{route('dashboard.edit',["id"=>Auth::user()->id])}}"><i class="fas fa-fw fa-cog"></i> &nbsp; Settings</a>
                    <div class="dropdown-divider"></div>
                    <form id="logout-form" action="{{ route('login.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>


                </div>
        @else
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="{{route('login.index')}}" id="messagesDropdown" role="button">Login
                </a>
            </li>
        @endif

    </ul>
</nav>
