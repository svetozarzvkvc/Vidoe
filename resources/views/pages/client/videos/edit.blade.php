@extends('layouts.layout')
@section('title')Vidoe - Edit @endsection
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid upload-details">
            @if(session('success-update'))
                <div class="alert-success success">
                    <p class="p-3">{{session('success-update')}}</p>
                </div>
            @endif
                @if(session('error-msg'))
                    <div class="alert-success success">
                        <p class="p-3">{{session('error-msg')}}</p>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach($errors->all() as $error)
                        <li class="p-2">{{$error}}</li>
                    @endforeach
                        </ul>
                    </div>
                @endif
            <form method="post" action="{{route('videos.update',['video'=>$video])}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="osahan-form">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="title">Video Title</label>
                                    <input type="text"
                                           id="title"
                                           name="title"
                                           placeholder="Contrary to popular belief, Lorem Ipsum (2020) is not."
                                           class="form-control"
                                           value="{{$video->title}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description">About</label>
                                    <textarea rows="3" name="description" id="description" class="form-control">{{$video->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h6>Category ( you can select upto 3 categories )</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row category-checkbox">
                            @foreach($categories as $category)
                                <div class="col-lg-2 col-xs-6 col-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="cat-{{$category->id}}" value="{{$category->id}}" name="categories[]"
                                        @if($video->getCategories->contains('name',$category->name)) checked @endif>
                                        <label class="custom-control-label" for="cat-{{$category->id}}">{{$category->name}}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="osahan-area text-center mt-3">
                        <button class="submit btn btn-outline-primary">Save Changes</button>
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
@endsection
