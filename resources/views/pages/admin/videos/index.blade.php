@extends('layouts.admin')

@section('additionalCss')
    @include('partials.datatables-css')
@endsection

@section('contentHeader')
    <h1>Videos</h1>
@endsection

@section('content')

    @if(session('success-msg'))
        <div class="alert-success">
            <p class="p-2">{{session('success-msg')}}</p>
        </div>
    @endif

    @if (session('error-msg'))
        <div class="alert alert-danger">
            <p>{{session('error-msg')}}</p>
        </div>
    @endif

    <div class="table-responsive">
        <table id="videoTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Duration</th>
                <th>Views</th>
                <th class="large-column">Created At</th>
                <th class="large-column">Updated At</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($videos as $key=>$v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->title }}</td>
                    <td>{{ $v->description }}</td>
                    <td>
                        <div class="video-image">
                            <img class="img-fluid " src="{{ asset('assets/thumbnail/' . $v->thumbnail) }}" alt="{{ $v->name }}"/>
                        </div>
                    </td>
                    <td>{{gmdate("i:s",$v->duration)}}</td>
                    <td>{{number_format($v->total_views)}}</td>
                    <td>{{ $v->created_at }}</td>
                    <td>{{ $v->updated_at ? : 'N/A' }}</td>
                    <td><a href="{{route('dashboard.videos.edit',['video'=>$v])}}"><i class="fas fa-edit"></i></a></td>
                    <td>
                        <form action="{{route('dashboard.videos.destroy',['video'=>$v])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('additionalScripts')
    <script>
        const table = "videoTable";
    </script>
    @include('partials.datatables-scripts')
@endsection
