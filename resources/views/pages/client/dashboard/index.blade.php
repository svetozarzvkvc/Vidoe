@extends('layouts.layout')
@section('title')Vidoe - Dashboard @endsection
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid pb-0">
            @if(session('success-deleted'))
                <div class="alert-success success">
                    <p class="p-3">{{session('success-deleted')}}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100 border-none">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-users"></i>
                            </div>
                            <div class="mr-5"><b>{{count($userSubs->subscriptions)}}</b> Channels</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100 border-none">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-video"></i>
                            </div>
                            <div class="mr-5"><b>{{count($userSubs->getVideos)}}</b> Videos</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-success o-hidden h-100 border-none">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-list-alt"></i>
                            </div>
                            <div class="mr-5"><b>{{($userSubs->getVideos->sum('total_likes'))}}</b> Likes</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-danger o-hidden h-100 border-none">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-cloud-upload-alt"></i>
                            </div>
                            <div class="mr-5"><b>{{($userSubs->getVideos->sum('total_dislikes'))}}</b> Dislikes</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                        </a>
                    </div>
                </div>
            </div>
            <hr>
                    <div id="videi">
                        @include('pages.client.channels.data')

                    </div>
            <hr class="mt-0">
        </div>
    </div>
    </div>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="created_at" />
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
    <input type="hidden" id="sortvrednost" value="asc">
@endsection
@section('scripts')
    <script src="{{asset('assets/js/channelPagination.js')}}"></script>
@endsection
