@extends('layouts.layout')
@section('title')Vidoe - Contact @endsection
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('messages'))
                    <div class="alert-success success">
                        <p class=" p-3">{{session('messages')}}</p>
                    </div>
                @endif


            <section class="section-padding">
                <div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <h3 class="mt-1 mb-4">Get In Touch</h3>
                            <h6 class="text-dark">Address :</h6>
                            <p>Terazije 22</p>
                            <h6 class="text-dark">Mobile :</h6>
                            <p>+381 64 888 999, +381 60 999 111</p>
                            <h6 class="text-dark">Email :</h6>
                            <p>
                                <a href="" class="__cf_email__">info@email.com</a>,
                            </p>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1260.817431831511!2d20.461039867535852!3d44.812610834218326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7aae659c3d43%3A0xbbfa2a3fa05067b3!2z0KLQtdGA0LDQt9C40ZjQtSwg0JHQtdC-0LPRgNCw0LQ!5e0!3m2!1ssr!2srs!4v1711581464993!5m2!1ssr!2srs"
                                        width="100%" height="340" frameborder="0" style="border:0"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <hr>

            <section class="section-padding">
                <div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 section-title text-left mb-4">
                            <h2>Contact Us</h2>
                        </div>

                        <form method="POST" action="{{route("contact.mail")}}" class="col-lg-12 col-md-12" name="sentMessage" id="contactForm" novalidate>
                            @csrf
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label for="email">Email address <span class="text-danger">*</span></label>
                                    <input type="email"  placeholder="Email address" class="form-control" id="email" name="email"
                                           required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                                <div class="control-group form-group">
                                    <div class="controls">
                                        <label for="subjectMoj">Subject <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="Subject" class="form-control"
                                               id="subjectMoj" required name="subjectMoj"
                                               data-validation-required-message="Please enter your subject of your message.">
                                    </div>
                                </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label for="messageMoj">Message <span class="text-danger">*</span></label>
                                    <textarea rows="8" cols="100" placeholder="Message" class="form-control"
                                              id="messageMoj" required
                                              name="messageMoj"
                                              data-validation-required-message="Please enter your message" maxlength="999"
                                              style="resize:none"></textarea>
                                </div>
                            </div>
                            <div id="success"></div>

                            <button type="submit" class="btn btn-success">Send Message</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
@endsection
