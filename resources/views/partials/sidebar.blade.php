<ul class="sidebar navbar-nav">
    @foreach($menu as $item)
            @if(count($item->getChildren) == 0 && $item->parent_id == null)
            <li class="nav-item @if(request()->routeIs($item->route))active @endif">
                <a class="nav-link" href="@if($item->route === 'history.show' || $item->route === 'liked.show' && \Illuminate\Support\Facades\Auth::check())
                {{route($item->route,['user'=>\Illuminate\Support\Facades\Auth::user()])}}
                @else
                {{route($item->route)}}
                @endif">

                <i class="{{$item->icon}}"></i>
                    <span>{{$item->name}}</span>
                </a>
            </li>
        @elseif(count($item->getChildren) >= 1)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i class="{{$item->icon}}"></i>
                                <span>{{$item->name}}</span>
                            </a>
                            <div class="dropdown-menu">
                                @foreach($item->getChildren as $child)
                                    <a class="dropdown-item @if(request()->routeIs($child->route)) active @endif" href="{{route($child->route)}}">{{$child->name}}</a>
                                @endforeach
                            </div>
                        </li>
            @endif
    @endforeach
    <li class="nav-item channel-sidebar-list">
        <h6>SUBSCRIPTIONS</h6>
        <ul id="sidebarsubs">
            @if(Auth::check())
                @foreach(Auth::user()->subscriptions as $sidebarSub)
                    @if($sidebarSub->id != Auth::user()->id)
                        <li class="channel-sidebar-list-item">
                            <input type="hidden" name="sidebar-item" class="sidebar-item" value="{{$sidebarSub->id}}"/>
                            <a href="{{route('channels.show',["channel"=>$sidebarSub])}}" >
                                <img class="img-fluid" alt src="{{asset('assets/img/'.$sidebarSub->avatar)}}"> {{$sidebarSub->username}}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </li>
</ul>
