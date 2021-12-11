@extends('frontend.app')

@section('title', 'Home page')

@section('content')
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-xl-7">
                    <div class="block">
                        <div class="divider mb-3"></div>
                        <span class="text-uppercase text-sm letter-spacing ">{{$doctor->profession}}</span>
                        <h1 class="mb-3 mt-3">{{$doctor->fullname()}}</h1>

                        <p class="mb-4 pr-5">{{$doctor->short_about}}</p>
                        <div class="btn-container ">
                            <a href="{{route('about')}}" class="btn btn-main-2 btn-icon btn-round-full">About me... <i class="icofont-simple-right ml-2  "></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')

@endsection

@section('js')

@endsection
