@extends('layouts.layout')
@section('title')Vidoe - {{$video->title}} @endsection
@section('content')
    @php
        use Illuminate\Support\Facades\Auth as Auth;
    @endphp
    <div id="content-wrapper">
        @if(Auth::check())
            <input type="hidden" id="userId" value="{{Auth::user()->id}}">
        @else
            <input type="hidden" id="userId" value="null">
        @endif
        <div class="container-fluid pb-0">
            <div class="video-block section-padding">
                <div class="row">
                    <div class="col-md-8">
                        <div class="single-video-left">
                            <div class="single-video">
{{--                                <iframe width="100%" height="315"--}}
{{--                                        src="https://www.youtube-nocookie.com/embed/8LWZSGNjuF0?rel=0&amp;controls=0&amp;showinfo=0"--}}
{{--                                        frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>--}}
                                <video width="100%" controls autoplay>
                                    <source src="{{asset('assets/video/'.$video->src)}}">
                                </video>
                            </div>
                            <div class="single-video-title box mb-3">
                                <h2><a href="#">{{$video->title}}</a></h2>
                                <p class="mb-2"><i class="fas fa-eye"></i> {{number_format($video->total_views)}} views
                                   </p>
                                <p>{{$video->created_at->format("F j, Y")}}</p>
{{--                                @dd($video->reactions)--}}
                                <a id="video-total-likes" class="total-like likeMojVideo @if(Auth::check() && $video->userLikedVideo(Auth::user()->id)) liked @endif" href="#"><i
                                        class="fas fa-thumbs-up"></i>
                                    {{count($video->getTotalLikes)}}</a> <a id="video-total-dislikes" class="total-like dislikeMojVideo @if(Auth::check() && $video->userDislikedVideo(Auth::user()->id)) disliked @endif" href="#"><i
                                        class="fas fa-thumbs-down"></i> {{count($video->getTotalDislikes)}}</a>

                            </div>
                            <div class="single-video-author box mb-3">
                                <input type="hidden" id="subscribed-id" name="subnesto" value="{{$video->getUser->id}}"/>
                                <div class="float-right">
                                    @if(Auth::check() && Auth::user()->id != $video->getUser->id)
                                    @if(Auth::check() &&Auth::user()->isSubscribedTo($video->getUser->id))
                                        <button id="subdugme" class="btn subscribe-button btn-outline-secondary" type="button">Subscribed </button>

                                        @else
                                        <button id="subdugme" class="btn btn-danger subscribe-button" type="button">Subscribe </button>
                                    @endif
                                    @else

                                    @endif

                                        <button class="btn btn btn-outline-danger" type="button"><i class="fas fa-bell"></i></button>
                                </div>
                                <img class="img-fluid" src="{{asset('assets/img/'.$video->getUser->avatar)}}" alt>
                                <p>
                                    <a href="{{route('channels.show',["channel"=>$video->getUser->id])}}"><strong>{{$video->getUser->username}}</strong></a>
                                    <span title data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i
                                            class="fas fa-check-circle text-success"></i></span>

                                </p>

                                <small id="subs-number">
                                    @if(count($video->getUser->subscribers) === 1)
                                    {{count($video->getUser->subscribers)." "."subscriber"}}
                                    @else
                                    {{count($video->getUser->subscribers)." "."subscribers"}}
                                    @endif
                                </small>

                            </div>
                            <div class="single-video-info-content box mb-3">
                                <h6>About :</h6>
                                <p>{{$video->description}} </p>
                                <h6>Categories :</h6>
                                <p class="tags mb-0">
                                    @foreach($video->getCategories as $cat)
                                        <span><a href="{{route('categoriesFilter',['category'=>$cat])}}">{{$cat->name}}</a></span>

                                    @endforeach
                                </p>
                                <input type="hidden" name="videoid" id="videoid" value="{{$video->id}}">
                            </div>
                            <!-- pocetak -->
                            <div class="box mb-3 single-video-comment-tabs">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="retro-comments" role="tabpanel"
                                         aria-labelledby="retro-comments-tab">
                                        <div class="reviews-members pt-0">
                                            <div class="media">
                                                @if(Auth::check())
                                                    <a href="{{route('dashboard.show',['id'=>Auth::user()])}}"><img class="mr-3" src="{{asset('assets/img/'.Auth::user()->avatar)}}"
                                                                                                                    alt="Generic placeholder image"></a>
                                                @else
                                                    <a href="{{route('login.index')}}"><img class="mr-3" src="{{asset('assets/img/defaultavatar.jpg')}}"
                                                                                            alt="Generic placeholder image"></a>
                                                @endif

                                                <div class="media-body">
                                                    <div class="form-members-body">
                                                            <textarea rows="1" id="main-comment-text" placeholder="Add a public comment..."
                                                                      class="form-control"></textarea>
                                                    </div>
                                                    <div class="form-members-footer text-right mt-2">
                                                        <b class="float-left" id="totalComments">{{count($video->getComments)}} Comments</b>
                                                        <button class="btn btn-outline-danger btn-sm " id="cancel-comment" type="button">
                                                            CANCEL
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" id="main-comment-submit" type="button">COMMENT
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="commentsMoje"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- kraj -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-video-right">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="adblock">
                                        <div class="img">
                                            Google AdSense<br>
                                            336 x 280
                                        </div>
                                    </div>
                                    <div class="main-title">
                                        <h6>Up Next</h6>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    @foreach($randomVideos as $video)
                                        <div class="video-card video-card-list">
                                            <div class="video-card-image">
                                                <a class="play-icon" href="{{route('videos.show',['video'=>$video])}}"><i class="fas fa-play-circle"></i></a>
                                                <a href="{{route('videos.show',['video'=>$video])}}"><img class="img-fluid" src="{{asset('assets/thumbnail/'.$video->thumbnail)}}" alt></a>
                                                <div class="time">{{gmdate("i:s",$video->duration)}}</div>
                                            </div>
                                            <div class="video-card-body">
                                                <div class="video-title">
                                                    <a href="{{route('videos.show',['video'=>$video])}}">{{$video->title}}</a>
                                                </div>
                                                <div class="video-page text-success">
                                                    {{$video->getCategories->first() ? $video->getCategories->first()->name : "No category"}} <a title data-placement="top" data-toggle="tooltip"
                                                                 href="#" data-original-title="Verified"><i
                                                            class="fas fa-check-circle text-success"></i></a>
                                                </div>
                                                <div class="video-view">
                                                    {{number_format($video->total_views)}} views &nbsp;<i class="fas fa-calendar-alt"></i> {{date('d-M-Y', strtotime($video->created_at))}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="adblock mt-0">
                                        <div class="img">
                                            Google AdSense<br>
                                            336 x 280
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="created_at" />
            <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
            <input type="hidden" id="sortvrednost" value="asc">
@endsection
@section('scripts')
                <script> const baseUrl = "{{url('/')}}"
                    var xxxRoute = "{{ route('channels.show', ['channel' => ':xxx']) }}";
                    var xxxAvatar = "{{asset('assets/img/'.":xxx1")}}";
                </script>
                <script src="{{asset('assets/js/comments.js')}}"></script>
                <script src="{{asset('assets/js/channelPagination.js')}}"></script>
@endsection
