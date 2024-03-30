@extends('layouts.auth_layout')
@section('content')
    <section class="login-main-wrapper">
        <div class="container-fluid pl-0 pr-0">
            <div class="row no-gutters">
                <div class="col-md-5 p-5 bg-white full-height">
                    <div class="login-main-left">
                        <div class="text-center mb-5 login-main-left-header pt-4">
                            <img src="{{asset('assets/img/favicon.png')}}" class="img-fluid" alt="LOGO">
                            <h5 class="mt-3 mb-3">Welcome to Vidoe</h5>
                            <p>It is a long established fact that a reader <br> will be distracted by the readable.</p>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>
                            </div>
                        @endif
                        @if(session('success-msg'))
                            <div class="alert alert-success">
                                <p>{{session('success-msg')}}</p>
                                <script>
                                    setTimeout(function() {
                                        window.location.href = "/"
                                    }, 10000);
                                </script>
                            </div>
                        @endif
                        <form action="{{route('register.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Enter username">
                            </div>
                            <div class="form-group" >
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-outline-primary btn-block btn-lg">Sign Up</button>
                            </div>
                        </form>
                        <div class="text-center mt-5">
                            <p class="light-gray">Already have an Account? <a href="{{route('login.index')}}">Sign In</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="login-main-right bg-white p-5 mt-5 mb-5">
                        <div class="owl-carousel owl-carousel-login">
                            <div class="item">
                                <div class="carousel-login-card text-center">
                                    <img src="{{asset('assets/img/login.png')}}" class="img-fluid" alt="LOGO">
                                    <h5 class="mt-5 mb-3">​Watch videos offline</h5>
                                    <p class="mb-4">when an unknown printer took a galley of type and scrambled<br> it
                                        to make a type specimen book. It has survived not <br>only five centuries</p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="carousel-login-card text-center">
                                    <img src="{{asset('assets/img/login.png')}}" class="img-fluid" alt="LOGO">
                                    <h5 class="mt-5 mb-3">Download videos effortlessly</h5>
                                    <p class="mb-4">when an unknown printer took a galley of type and scrambled<br> it
                                        to make a type specimen book. It has survived not <br>only five centuries</p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="carousel-login-card text-center">
                                    <img src="{{asset('assets/img/login.png')}}" class="img-fluid" alt="LOGO">
                                    <h5 class="mt-5 mb-3">Create GIFs</h5>
                                    <p class="mb-4">when an unknown printer took a galley of type and scrambled<br> it
                                        to make a type specimen book. It has survived not <br>only five centuries</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
