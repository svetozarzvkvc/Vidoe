<footer class="sticky-footer {{request()->routeIs(['login','channels.show']) ? 'ml-0' : ''}}">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-6 col-sm-6">
                <p class="mt-1 mb-0">&copy; Copyright 2020 <strong class="text-dark">Vidoe</strong>. All
                    Rights Reserved<br>
                    <small class="mt-0 mb-0">Made with <i class="fas fa-heart text-danger"></i> by <a
                            class="text-primary" target="_blank" href="https://askbootstrap.com/">Ask
                            Bootstrap</a>
                    </small>
                </p>
            </div>
            <div class="col-lg-6 col-sm-6 text-right">
                <div class="app">
                    <a href="#"><img alt src="{{asset('assets/img/google.png')}}"></a>
                    <a href="#"><img alt src="{{asset('assets/img/apple.png')}}"></a>
                </div>
            </div>
        </div>
    </div>
</footer>
