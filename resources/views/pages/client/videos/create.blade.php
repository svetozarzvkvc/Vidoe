@extends('layouts.layout')
@section('title')Vidoe - Upload @endsection
@section('content')
    <div id="content-wrapper">



        <div class="container-fluid upload-details">
            @if ($errors->any())
                <div class="pt-3 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>
                </div>
            @endif

            @if(session('success-message'))
                <div class="alert alert-success">
                     <p class="pt-1">{{session('success-message')}}</p>
                </div>
            @endif

            @if(session('error-msg'))
                <div class="alert alert-danger">
                      <p class="p-2">{{session('error-msg')}}</p>
                </div>
            @endif
            <form action="{{route('videos.store')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h6>Upload Details</h6>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="imgplace"></div>
                </div>
                <div class="col-lg-10">
                    <div class="osahan-title">Contrary to popular belief, Lorem Ipsum (2020) is not.</div>
                    <div class="osahan-size">102.6 MB . 2:13 MIN Remaining</div>
                    <div class="osahan-progress">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div>
                        <div class="osahan-close">
                            <a href="#"><i class="fas fa-times-circle"></i></a>
                        </div>
                    </div>
                    <div class="osahan-desc">Your Video is still uploading, please keep this page open until it's
                        done.</div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="osahan-form">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="title">Video Title</label>
                                    <input type="text"
                                           placeholder="Contrary to popular belief, Lorem Ipsum (2020) is not."
                                           class="form-control"
                                           name="title"
                                           id="title"
                                           value="{{old('title')}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description">About</label>
                                    <textarea rows="3" class="form-control" name="description" id="description" >{{old('description')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h6>Category ( you can select upto 3 categories )</h6>
                                </div>
                            </div>
                        </div>

                        <div class="row category-checkbox">
                            @foreach($kategorije as $kategorija)
                                <div class="col-lg-2 col-xs-6 col-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="cat-{{$kategorija->id}}" value="{{$kategorija->id}}" name="categories[]"
                                        @if(old('categories')&& in_array($kategorija->id, old('categories'))) checked @endif/>
                                        <label class="custom-control-label" for="cat-{{$kategorija->id}}">{{$kategorija->name}}</label>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="mt-1">
                        <label for="video" class="form-label">Upload video</label>
                        <input type="file"  name="video" id="video" class="form-control height-auto">
                    </div>

                    <div class="osahan-area text-center mt-3">
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
{{--                        <button class="btn btn-outline-primary">Save Changes</button>--}}
                    </div>
                    <hr>
                    <div class="terms text-center">
                        <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the
                            majority <a href="#">Terms of Service</a> and <a href="#">Community Guidelines</a>.</p>
                        <p class="hidden-xs mb-0">Ipsum is therefore always free from repetition, injected humour,
                            or non</p>
                    </div>
                </div>

            </div>
            </form>
        </div>
        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="created_at" />
        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
        <input type="hidden" id="sortvrednost" value="asc">
@endsection
