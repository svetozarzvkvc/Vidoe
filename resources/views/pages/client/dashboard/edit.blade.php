@extends('layouts.layout')
@section('title')Vidoe - Edit profile @endsection
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid  upload-details">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h6>Settings</h6>
                    </div>
                </div>
            </div>

            @if(session('success-updated'))
                <div class="alert-success success">
                    <p class="p-3">{{session('success-updated')}}</p>
                </div>
            @endif


            <div class="container mt-4 min-vh-100">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="p-2">{{ $error }}</li>
                            @endforeach

                        </ul>
                    </div>
                @endif

            <form action="{{route('dashboard.update',['user'=>$userData])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="username">Username <span class="required">*</span></label>
                            <input class="form-control border-form-control" id="username" name="username" value="{{old('username')}}"
                                   type="text">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="email">Email Address <span class="required">*</span></label>
                            <input class="form-control border-form-control " name="email" id="email" value="{{old('email')}}"
                                   type="email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label" for="country">Country <span class="required">*</span></label>
                            <select class="custom-select" id="country" name="country">
                                <option value>Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}" @if(old('country') == $country->id) selected @endif>{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label" for="avatar">Avatar <span class="required">*</span></label>
                            <input class="form-control border-form-control height-auto" id="avatar" name="avatar" value
                                   type="file">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-right">
                        <button type="reset" class="btn btn-danger border-none"> Cancel </button>
                        <button type="submit" class="btn btn-success border-none"> Save Changes </button>
                    </div>
                </div>

            </form>
        </div>
@endsection
