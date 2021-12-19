@extends('frontend.app')

@section('title', 'My skills')

@section('content')
    <section class="section service-2">
        <div class="container">
            <div class="row">
                @foreach($doctor->skills as $skill)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="service-block mb-5">
                            <img src="{{$skill->image}}"
                                 alt="{{$skill->name}}" class="img-fluid">
                            <div class="content">
                                <h4 class="mt-4 mb-2 title-color">{{$skill->name}}</h4>
                                <small>since {{$skill->experience}}</small>
                                <p class="mb-4">{{$skill->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('css')

@endsection

@section('js')

@endsection
