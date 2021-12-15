<div class="col-lg-4">
    <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
        <div class="sidebar-widget search  mb-3 ">
            <h5>Search Here</h5>
            <form action="{{route('blog.index')}}" class="search-form" method="get">
                <input value="{{$search??''}}" type="text" class="form-control" name="search" placeholder="search">
                <i class="ti-search"></i>
            </form>
        </div>
        <div class="sidebar-widget latest-post mb-3">
            <h5>Popular Posts</h5>
            @forelse($popular_blogs as $popular_blog)
                <div class="py-2">
                    <span class="text-sm text-muted">{{$popular_blog->created_at}}</span>
                    <h6 class="my-2"><a href="{{route('blog.show', [$popular_blog->slug])}}">{{$popular_blog->title}}</a></h6>
                </div>
            @empty
                No blog...
            @endforelse
        </div>

        <div class="sidebar-widget category mb-3">
            <h5 class="mb-4">Categories</h5>

            <ul class="list-unstyled">
                @foreach ($categories as $category)
                    <li class="align-items-center">
                        <a href="{{route('blog.index', [$category->slug])}}">{{$category->name}}</a>
                        <span>({{$category->blogs_count}})</span>
                    </li>
                @endforeach
            </ul>
        </div>


        <div class="sidebar-widget tags mb-3">
            <h5 class="mb-4">Tags</h5>

            <a href="#">Doctors</a>
            <a href="#">agency</a>
            <a href="#">company</a>
            <a href="#">medicine</a>
            <a href="#">surgery</a>
            <a href="#">Marketing</a>
            <a href="#">Social Media</a>
            <a href="#">Branding</a>
            <a href="#">Laboratory</a>
        </div>


{{--        <div class="sidebar-widget schedule-widget mb-3">--}}
{{--            <h5 class="mb-4">Time Schedule</h5>--}}

{{--            <ul class="list-unstyled">--}}
{{--                <li class="d-flex justify-content-between align-items-center">--}}
{{--                    <a href="#">Monday - Friday</a>--}}
{{--                    <span>9:00 - 17:00</span>--}}
{{--                </li>--}}
{{--                <li class="d-flex justify-content-between align-items-center">--}}
{{--                    <a href="#">Saturday</a>--}}
{{--                    <span>9:00 - 16:00</span>--}}
{{--                </li>--}}
{{--                <li class="d-flex justify-content-between align-items-center">--}}
{{--                    <a href="#">Sunday</a>--}}
{{--                    <span>Closed</span>--}}
{{--                </li>--}}
{{--            </ul>--}}

{{--            @if($doctor->phone)--}}
{{--                <div class="sidebar-contatct-info mt-4">--}}
{{--                    <p class="mb-0">Need Urgent Help?</p>--}}
{{--                    <h3><a href="tel:{{$doctor->phone}}">{{$doctor->phone}}</a></h3>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}

    </div>
</div>
