@extends('layouts.admin')

@section('additionalCss')
    @include('partials.datatables-css')
@endsection

@section('contentHeader')
    <h1>Users</h1>
@endsection

@section('content')
    <a href="{{route('dashboard.users.create')}}" class="btn btn-primary">Add new user</a>

    @if(session('success-msg'))
        <div class="alert-success mt-3">
            <p class="p-2">{{session('success-msg')}}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif

    @if (session('error-msg'))
        <div class="alert alert-danger mt-3">
            <p>{{session('error-msg')}}</p>
        </div>
    @endif


    <div class="table-responsive">
        <table id="usersTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th class="large-column">Created At</th>
                <th class="large-column">Updated At</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key=>$u)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->role->name }}</td>
                    <td>{{ $u->created_at }}</td>
                    <td>{{ $u->updated_at ? : 'N/A' }}</td>
                    <td><a href="{{route('dashboard.users.edit',['user'=>$u])}}"><i class="fas fa-edit"></i></a></td>
                    <td>
                        <form action="{{route('dashboard.users.destroy',['user'=>$u])}}" method="POST">
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
        const table = "usersTable";
    </script>
    @include('partials.datatables-scripts')
@endsection
