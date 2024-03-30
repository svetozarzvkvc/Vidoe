@extends('layouts.admin')

@section('contentHeader')
    <h1>Add new user</h1>
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
    <form action="{{route('dashboard.users.store')}}" method="POST" class="standard-form" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" id="username" placeholder="Name"/>
            <span class="font-small error-message">This field is required</span>
        </div>
        <div class="mb-3">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="Email"/>
            <span class="font-small error-message">This field is required</span>
        </div>
        <div class="mb-3">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="Password"/>
            <span class="font-small error-message">This field is required</span>
        </div>
        <div class="text-center">
            <input class="btn btn-primary" type="submit" value="Submit" />
        </div>
    </form>
@endsection
