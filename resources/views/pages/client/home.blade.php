@extends('layouts.layout')
@section('title')Vidoe - Home @endsection
@section('content')
@php
    use Illuminate\Support\Facades\Auth as Auth;
@endphp
    <div id="content-wrapper">
        <div class="container-fluid pb-0">
            <div class="top-mobile-search">
                <div class="row">
                    <div class="col-md-12">
                        <form id="search-form" class="mobile-search">
                            <div class="input-group">
                                <input id="search-video-input" type="text" placeholder="Search for..." class="form-control">
                                <div class="input-group-append">
                                    <button onclick="submit" type="button" class="btn btn-dark"><i
                                            id="search-video-button" class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="top-category section-padding mb-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-title">
                            <h6>Channels Categories</h6>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="owl-carousel owl-carousel-category">
                            @foreach($categories as $cat)
                                <div class="item">
                                    <div class="category-item">
                                        <a href="{{route('categoriesFilter',['category'=>$cat])}}">
                                            <h6>{{$cat->name}}</h6>
                                            <p>{{number_format($cat->getVideos->sum('total_views'))}} views</p>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div id="videi">
                @include('pages.client.channels.data')
            </div>
            <hr class="mt-0">
            <div class="video-block section-padding">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-title">
                            <h6>Popular Channels</h6>
                        </div>
                    </div>


                    @foreach($users as $userChannel)

                        <div class="col-xl-3 col-sm-6 mb-3 popular-users">
                            <input type="hidden" id="subscribed-id" class="subscribed-id" name="subnesto" value="{{$userChannel->id}}"/>
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="{{route('channels.show',['channel'=>$userChannel])}}"><img class="img-fluid" src="{{asset('assets/img/'.$userChannel->avatar)}}" alt></a>
                                    <div class="channels-card-image-btn">
                                        @if(Auth::check() && Auth::user()->id != $userChannel->id)
                                            @if(Auth::user()->isSubscribedTo($userChannel->id))
                                                <button type="button" class="btn btn-outline-secondary btn-sm subscribe-button-mini">Subscribed
                                                </button>
                                            @else
                                                <button type="button" id="sidebarsub" class="btn btn-outline-danger btn-sm subscribe-button-mini">Subscribe
                                                </button>
                                            @endif
                                        @else
                                        @endif
                                    </div>

                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="{{route('channels.show',['channel'=>$userChannel])}}">{{$userChannel->username}}</a>
                                    </div>
                                    <div class="channels-view total-subs">
                                        @if(count($userChannel->subscribers) === 1)
                                            {{count($userChannel->subscribers)}} subscriber
                                        @else
                                            {{count($userChannel->subscribers)}} subscribers
                                        @endif
                                    </div>
                                    <div class="channels-view">
                                        @if($userChannel->getVideos->sum('total_views') === 1)
                                            {{number_format($userChannel->getVideos->sum('total_views'))}} view
                                        @else
                                            {{number_format($userChannel->getVideos->sum('total_views'))}} views
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach





                </div>
            </div>
        </div>

        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="created_at" />
        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
        <input type="hidden" id="sortvrednost" value="asc">
@endsection
        @section('scripts')
            <script>
                var xxxRoute = "{{ route('channels.show', ['channel' => ':xxx']) }}";
                var xxxAvatar = "{{asset('assets/img/'.":xxx1")}}";
            </script>
            <script src="{{asset('assets/js/channelPagination.js')}}"></script>

@endsection
