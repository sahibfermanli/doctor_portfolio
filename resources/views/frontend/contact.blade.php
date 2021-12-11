@extends('frontend.app')

@section('title', 'Contact me')

@section('content')
    <section class="section contact-info pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="contact-block mb-4 mb-lg-0">
                        <i class="icofont-live-support"></i>
                        <h5>Call Me</h5>
                        <a href="tel:{{$doctor->phone}}">{{$doctor->phone}}</a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="contact-block mb-4 mb-lg-0">
                        <i class="icofont-support-faq"></i>
                        <h5>Email</h5>
                        <a href="mailto:{{$doctor->email}}">{{$doctor->email}}</a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="contact-block mb-4 mb-lg-0">
                        <i class="icofont-location-pin"></i>
                        <h5>Location</h5>
                        {{$doctor->location}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-form-wrap section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h2 class="text-md mb-2">Contact me</h2>
                        <div class="divider mx-auto my-4"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <form method="post" action="{{route('contact.store')}}">
                        @csrf
                        @if($errors->any())
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-warning contact__msg" role="alert">
                                        @foreach($errors->all() as $error)
                                            <p>{{$error}}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(Session::get('message'))
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-{{Session::get('status')}} contact__msg" role="alert">
                                        {{Session::get('message')}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="fullname" id="fullname" type="text" class="form-control"
                                           placeholder="Your Full Name" maxlength="100" value="{{old('fullname')}}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="email" id="email" type="email" class="form-control"
                                           placeholder="Your Email Address" maxlength="100" value="{{old('email')}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="phone" id="phone" type="text" class="form-control"
                                           placeholder="Your Phone Number" maxlength="15" value="{{old('phone')}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="topic" id="topic" type="text" class="form-control"
                                           placeholder="Your Query Topic" maxlength="255" value="{{old('topic')}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group-2 mb-4">
                            <textarea name="message" id="message" class="form-control" rows="8"
                                      placeholder="Your Message" maxlength="5000">{{old('message')}}</textarea>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-main btn-round-full" type="submit">Send Messege</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')

@endsection

@section('js')

@endsection
