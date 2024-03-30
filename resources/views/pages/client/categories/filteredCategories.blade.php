@extends('layouts.layout')
@section('title')Vidoe - Categories @endsection
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <div id="videi">
                @include('pages.client.channels.data')
            </div>
        </div>
        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="created_at" />
        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
        <input type="hidden" id="sortvrednost" value="asc">
@endsection
    </div>
@section('scripts')
    <script src="{{asset('assets/js/channelPagination.js')}}"></script>
@endsection
