@extends('layouts.admin')

@section('additionalCss')
    @include('partials.datatables-css')
@endsection

@section('contentHeader')
    <h1>Video categories</h1>
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


    <a href="{{route('categories.create')}}" class="btn btn-primary">Add new category</a>
    <div class="table-responsive">
        <table id="categoriesTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Number of videos</th>
                <th class="large-column">Created At</th>
                <th class="large-column">Updated At</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $key=>$c)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->videosCount() }}</td>
                    <td>{{ $c->created_at }}</td>
                    <td>{{ $c->updated_at ? : 'N/A' }}</td>
                    <td><a href="{{route('categories.edit',['category'=>$c])}}"><i class="fas fa-edit"></i></a></td>
                    <td>
                        <form action="{{route('categories.destroy',['category'=>$c])}}" method="POST">
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
        const table = "categoriesTable";
    </script>
    @include('partials.datatables-scripts')
@endsection

