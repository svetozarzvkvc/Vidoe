@extends('layouts.layout')
@section('title')Vidoe - {{$userData->username}} @endsection
@section('content')
    <div id="content-wrapper" class="single-channel-page">
        <input type="hidden" id="subscribed-id" class="subscribed-id" name="subnesto" value="{{$userData->id}}"/>

        <div class="single-channel-image">
            <img class="img-fluid" alt src="{{asset('assets/img/channel-banner.png')}}">
            <div class="channel-profile">
                <img class="channel-profile-img" alt src="{{asset('assets/img/'.$userData->avatar)}}">
                <div class="social hidden-xs">
                    Social &nbsp;
                    <a class="fb" href="#">Facebook</a>
                    <a class="tw" href="#">Twitter</a>
                    <a class="gp" href="#">Google</a>
                </div>
            </div>
        </div>
        <div class="single-channel-nav ">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="channel-brand" href="#">{{$userData->username}} <span title data-placement="top"
                                                                                data-toggle="tooltip" data-original-title="Verified"><i
                            class="fas fa-check-circle text-success"></i></span>



                </a>
                <small class="mt-1 ml-2 mr-2 text-justify total-subs">
                    @if(count($userData->subscribers) === 1)
                        {{count($userData->subscribers)}} subscriber
                    @else
                        {{count($userData->subscribers)}} subscribers
                    @endif
                </small>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Videos <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Playlist</a>
                        </li>
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="#">Channels</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link" href="#">Discussion</a>--}}
                        {{--                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Donate
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                    </ul>
                    <form id="search-form" class="form-inline my-2 my-lg-0">
                        <input class="form-control form-control-sm mr-sm-1 bottom-input" id="search-video-input1" type="search" placeholder="Search"
                               aria-label="Search"><button onclick="submit" class="btn btn-outline-success btn-sm my-2 my-sm-0"
                                                           id="search-video-button"><i class="fas fa-search"></i></button>


                    </form>
                    @if(Auth::check() && Auth::user()->id != $userData->id)
                        @if(Auth::user()->isSubscribedTo($userData->id))
                            &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-outline-secondary btn-sm subscribe-button-mini-kanal">Subscribed
                            </button>
                        @else
                            &nbsp;&nbsp;&nbsp;<button type="button" id="sidebarsub" class="btn btn-outline-danger btn-sm subscribe-button-mini-kanal ">Subscribe
                            </button>
                        @endif
                    @else

                    @endif
                </div>

            </nav>

        </div>
        <div class="container-fluid" id="videi">
                @include('pages.client.channels.data')
        </div>


        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="created_at" />
        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
        <input type="hidden" id="sortvrednost" value="asc">
        @endsection

        @section('scripts')

            <script>
                var xxxRoute = "{{ route('channels.show', ['channel' => ':xxx']) }}";
                var xxxVideoRoute = "{{ route('videos.show', ['video' => ':video']) }}";
                var xxxAvatar = "{{asset('assets/img/'.":xxx1")}}";
                var xxxThumbnail = "{{asset('assets/thumbnail/'.":thumbnail")}}";

            </script>
            <script src="{{asset('assets/js/channelPagination.js')}}"></script>
@endsection
