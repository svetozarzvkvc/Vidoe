@extends('layouts.admin')

@section('contentHeader')
    <h1>Edit category</h1>
@endsection

@section('content')

    @if(session('success-msg'))
        <div class="alert-success">
            <p class="p-2">{{session('success-msg')}}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif

    @if (session('error-msg'))
        <div class="alert alert-danger">
            <p>{{session('error-msg')}}</p>
        </div>
    @endif
    <form id="restaurantForm" action="{{route('categories.update',['category'=>$category])}}" method="POST" class="standard-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="categoryname">Username</label>
            <input class="form-control" type="text" value="{{$category->name}}" name="categoryname" id="categoryname" placeholder="Name"/>
            <span class="font-small error-message">This field is required</span>
        </div>
        <div class="text-center">
            <input class="btn btn-primary" type="submit" value="Submit" />
        </div>
    </form>
@endsection
