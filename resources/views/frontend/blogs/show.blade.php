@extends('frontend.app')

@section('title', $blog->title)

@section('socials')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0" nonce="Rxgy28um"></script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
@endsection

@section('content')
    <section class="section blog-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <div class="single-blog-item">
                                @if($blog->image)
                                    <img src="{{$blog->image}}" alt="{{$blog->title}}" class="img-fluid ">
                                @endif

                                <div class="blog-item-content mt-5">
                                    <div class="blog-item-meta mb-3">
                                        <span class="text-color-2 text-capitalize mr-3"><i
                                                class="icofont-book-mark mr-2"></i>{{$blog->category->name}}</span>
                                        <span class="text-muted text-capitalize mr-3"><i
                                                class="icofont-comment mr-2"></i>
                                            {{count($blog->comments) === 0 ? 'No comment' : count($blog->comments) . ' ' . Str::plural('comment', count($blog->comments))}}
                                        </span>
                                        <span style="margin-right: 10px;"><img style="height: 25px;" alt="eye" src="{{asset('frontend/images/blog/eye.png')}}"/> {{$blog->read_count}}</span>
                                        <span class="text-black text-capitalize mr-3"><i
                                                class="icofont-calendar mr-2"></i>{{$blog->created_at}}</span>
                                    </div>

                                    <h2 class="mb-4 text-md"><a>{{$blog->title}}</a></h2>

                                    {!! $blog->content !!}

                                    <div class="mt-5 clearfix">
{{--                                        <ul class="float-left list-inline tag-option">--}}
{{--                                            <li class="list-inline-item"><a href="#">Advancher</a></li>--}}
{{--                                            <li class="list-inline-item"><a href="#">Landscape</a></li>--}}
{{--                                            <li class="list-inline-item"><a href="#">Travel</a></li>--}}
{{--                                        </ul>--}}

                                        <ul class="float-right list-inline">
                                            <li class="list-inline-item"> Share:</li>
                                            <li class="list-inline-item" style="line-height: 12px;">
                                                <div class="fb-share-button"
                                                     data-href="{{url()->current()}}"
                                                     data-layout="button_count"
                                                     data-size="small">
                                                    <a target="_blank"
                                                       href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                                                       class="fb-xfbml-parse-ignore">
                                                        Share
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">
                                                    Tweet
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(count($blog->comments) > 0)
                            <div class="col-lg-12">
                                <div class="comment-area mt-4 mb-5">
                                    <h4 class="mb-4">{{count($blog->comments) . ' ' . Str::plural('comment', count($blog->comments))}}</h4>
                                    <ul class="comment-tree list-unstyled">
                                        @foreach($blog->comments as $comment)
                                            <li class="mb-5">
                                                <div class="comment-area-box">
                                                    <div class="comment-thumb float-left">
                                                        <img alt="{{$comment->name}}" src="{{asset('frontend/images/blog/testimonial1.jpg')}}" class="img-fluid">
                                                    </div>

                                                    <div class="comment-info">
                                                        <h5 class="mb-1">{{$comment->name}}</h5>
                                                        <span class="date-comm">{{$comment->created_at}}</span>
                                                    </div>
                                                    <div class="comment-meta mt-2">
                                                        <a href="#"><i class="icofont-reply mr-2 text-muted"></i>Reply</a>
                                                    </div>

                                                    <div class="comment-content mt-3">
                                                        <p>{{$comment->content}}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif


                        <div class="col-lg-12">
                            <form class="comment-form my-5" id="comment-form" method="post" action="{{route('blog.add_comment', [$blog->id])}}">
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
                                <h4 class="mb-4">Write a comment</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="name" id="name" placeholder="Name:">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" type="email" name="email" id="email" placeholder="Email:">
                                        </div>
                                    </div>
                                </div>

                                <textarea class="form-control mb-4" name="content" id="content" cols="30" rows="5" placeholder="Comment"></textarea>

                                <input class="btn btn-main-2 btn-round-full" type="submit" name="submit-contact" id="submit_contact" value="Submit Message">
                            </form>
                        </div>
                    </div>
                </div>

                @include('frontend.blogs.components.sidebar')
            </div>
        </div>
    </section>
@endsection

@section('css')

@endsection

@section('js')

@endsection
