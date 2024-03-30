
<div class="video-block section-padding">
        <div class="row">
            <div class="col-md-12">
                <div class="main-title">
                    <div class="btn-group float-right right-action">
                        <a href="#" class="right-action-link text-gray" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="sorting dropdown-item "  data-sorting_type="asc" data-column_name="duration"  href="#">Duration <i class="fa fa-arrow-down" aria-hidden="true"></i> </a>
                            <a class="sorting dropdown-item " data-sorting_type="asc" data-column_name="total_views" href="#">Views <i class="fa fa-arrow-down" aria-hidden="true"></i></a>

                            <a class="sorting dropdown-item "  data-sorting_type="desc" data-column_name="duration"  href="#">Duration <i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                            <a class="sorting dropdown-item " data-sorting_type="desc" data-column_name="total_views" href="#">Views <i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                            <a class="dropdown-item" href="#">
                                Close</a>
                        </div>
                    </div>
                    <h6>{{$page}}</h6>
                </div>
            </div>
            @if ($videosData->isEmpty())
                <div class="p-3 h2">No videos found.</div>
            @else
            @foreach($videosData as $video)

                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="video-card">
                        <div class="video-card-image">
                            <a class="play-icon" href="{{route('videos.show',['video'=>$video])}}"><i class="fas fa-play-circle"></i></a>
                            @if($page == 'My videos')
                                <div class="actions">



                                    <form id="delete-form" action="{{ route('videos.destroy', ['video' => $video]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    <a href="{{route('videos.edit',["video"=>$video])}}"><i class="fas fa-pencil-alt edit-icon bi "></i></a>

                                        <button type="submit" style="background-color: transparent; border: none;">
                                            <i class="fas fa-trash-alt delete-icon bi p-2"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif

                            @if($page == 'History')
                                    <div class="actions">
                                        <form id="delete-form" action="{{ route('history.destroy', ['video' => $video->id]) }}" method="post" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background-color: transparent; border: none;">
                                                <i class="fas fa-trash-alt delete-icon bi p-2"></i>
                                            </button>
                                        </form>
                                    </div>

                            @endif

                            @if($page == 'Liked videos')
                                <div class="actions">
                                    <form id="delete-form" action="{{ route('liked.destroy', ['video' => $video]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background-color: transparent; border: none;">
                                            <i class="fas fa-trash-alt delete-icon bi p-2"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif

                            <a href="{{route('videos.show',['video'=>$video])}}"><img class="img-fluid" src="{{asset('assets/thumbnail/'.$video->thumbnail)}}" alt></a>
                            <div class="time">{{gmdate("i:s",$video->duration)}}</div>
                        </div>
                        <div class="video-card-body">
                            <div class="video-title">
                                <div class="single-video-author mt-2 mb-3">
                                    <div class="mt-0 mb-2">
                                        <a href="{{route('videos.show',['video'=>$video])}}">{{$video->title}}</a>
                                    </div>
                                    <img class="img-fluid" src="{{asset('assets/img/'.$video->getUser->avatar)}}" alt>
                                    <p class="pt-2">
                                        <a href="{{route('channels.show',["channel"=>$video->getUser->id])}}"><strong>{{$video->getUser->username}}</strong></a>
                                        <span title data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i
                                                class="fas fa-check-circle text-success"></i></span>
                                    </p>
                                </div>
                            </div>
                            <div class="video-page text-success">
                                {{$video->getCategories->first() ? $video->getCategories->first()->name : "No category"}} <a title data-placement="top" data-toggle="tooltip" href="#"
                                                                            data-original-title="Verified"><i
                                        class="fas fa-check-circle text-success"></i></a>
                            </div>
                            <div class="video-view">
                                {{number_format($video->total_views)}} views  &nbsp;<i class="fas fa-calendar-alt"></i> {{date('d-M-Y', strtotime($video->created_at))}}
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
            @endif
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center pagination-sm mb-0">
                <li>
                    {!!$videosData->links()!!}

                </li>
            </ul>
        </nav>
</div>



