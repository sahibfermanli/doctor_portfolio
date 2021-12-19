@extends('frontend.app')

@section('title', 'My Information')

@section('content')
    <section class="section doctor-single gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="doctor-img-block">
                        <img src="{{$doctor->profile_image}}" alt="{{$doctor->fullname(true)}}" class="img-fluid w-100">
                        <div class="info-block mt-4">
                            <h4 class="mb-0">{{$doctor->fullname()}}</h4>
                            <p>{{$doctor->profession}}</p>

                            <ul class="list-inline mt-4 doctor-social-links">
                                @foreach($doctor->socials as $social)
                                    <li class="list-inline-item"><a href="{{$social->url}}" target="_blank"><i class="{{$social->icon}}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-6">
                    <div class="doctor-details mt-4 mt-lg-0">
                        <h2 class="text-md">Introducing to myself</h2>
                        <div class="divider my-4"></div>
                        {!! $doctor->about !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section doctor-qualification">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h3>My Educational Qualifications</h3>
                        <div class="divider my-4"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    @foreach($doctor->education as $education)
                        <div class="edu-block mb-5">
                            <span class="h6 text-muted">Year ({{date('Y', strtotime($education->start_date))}} - {{$education->end_date ? date('Y', strtotime($education->end_date)) : 'Present'}}) </span>
                            <h4 class="mb-3 title-color" style="text-transform: capitalize;">{{$education->degree}}, {{$education->university}}</h4>
                            <p>{{$education->section}}</p>
                            <p>{!! $education->description !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')

@endsection

@section('js')

@endsection
