@extends('layouts.admin')

@section('contentHeader')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <div class="row">
        @foreach($stats as $stat)
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white {{$stat['color']}} o-hidden h-100 border-none">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-lg {{$stat['icon']}}"></i>
                        </div>
                        <div class="mr-5 pt-3"><b>{{$stat['count']}}</b> {{$stat['text']}}</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{route($stat['route'])}}">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
