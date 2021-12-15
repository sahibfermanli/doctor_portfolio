@extends('frontend.app')

@section('title', 'Blogs')

@section('content')
    <section class="section blog-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @forelse($blogs as $blog)
                            <div class="col-lg-12 col-md-12 mb-5">
                                <div class="blog-item">
                                    @if($blog->image)
                                        <div class="blog-thumb">
                                            <img src="{{$blog->image}}" alt="{{$blog->title}}" class="img-fluid ">
                                        </div>
                                    @endif

                                    <div class="blog-item-content">
                                        <div class="blog-item-meta mb-3 mt-4">
                                        <span class="text-muted text-capitalize mr-3"><i
                                                class="icofont-comment mr-2"></i>
                                            {{$blog->comments_count === 0 ? 'No comment' : $blog->comments_count . ' ' . Str::plural('comment', $blog->comments_count)}}
                                        </span>
                                            <span style="margin-right: 10px;"><img style="height: 25px;" alt="eye"
                                                                                   src="{{asset('frontend/images/blog/eye.png')}}"/> {{$blog->read_count}}</span>
                                            <span class="text-black text-capitalize mr-3"><i
                                                    class="icofont-calendar mr-1"></i>{{$blog->created_at}}</span>
                                        </div>

                                        <h2 class="mt-3 mb-3"><a
                                                href="{{route('blog.show', [$blog->slug])}}">{{$blog->title}}</a></h2>

                                        <p class="mb-4">{{$blog->short_content}}</p>

                                        <a href="{{route('blog.show', [$blog->slug])}}"
                                           class="btn btn-main btn-icon btn-round-full">Read More <i
                                                class="icofont-simple-right ml-2  "></i></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-lg-12 col-md-12 mb-5">
                                <div class="blog-item">
                                    <div class="blog-item-content">
                                        <h2>No Blogs!</h2>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                @include('frontend.blogs.components.sidebar')
            </div>

            <div class="row mt-5">
                <div class="col-lg-8">
                    <nav class="pagination py-2 d-inline-block">
                        <div class="nav-links">
                            {!! $blogs->links('vendor.pagination.blog'); !!}
{{--                            <span aria-current="page" class="page-numbers current">1</span>--}}
{{--                            <a class="page-numbers" href="#">2</a>--}}
{{--                            <a class="page-numbers" href="#">3</a>--}}
{{--                            <a class="page-numbers" href="#"><i class="icofont-thin-double-right"></i></a>--}}
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')

@endsection

@section('js')

@endsection
