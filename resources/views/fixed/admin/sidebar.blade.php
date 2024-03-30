<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ asset('assets/vendor/AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Vidoe</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/img/defaultavatar.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#!" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->username}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @foreach($menuAdmin as $item)
                    <li class="nav-item">
                        <a href="{{ route($item->route) }}" class="nav-link @if(request()->routeIs($item->route)) active @endif">
                            @if($item->icon) <i class="{{ $item->icon }} nav-icon"></i> @endif
                            <p>{{ $item->name }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="sidebar-custom">
        <form action="{{ route('login.logout') }}" method="POST">
            @csrf
            <a href="" class="btn btn-link"><i class="fas fa-sign-out-alt"></i></a>
            <input type="submit" class="btn btn-secondary hide-on-collapse pos-right" value="Log out"/>
        </form>
        <a href="{{ route('home') }}" class="btn btn-secondary hide-on-collapse">Log out</a>
    </div>
    <!-- /.sidebar-custom -->
</aside>
