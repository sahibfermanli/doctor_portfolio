<footer class="footer section gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mr-auto col-sm-6">
                <div class="widget mb-5 mb-lg-0">
                    <div class="logo mb-4">
                        <img src="{{asset($doctor->logo??'frontend/images/logo/default.png')}}" alt="{{$doctor->fullname()}}" class="img-fluid" style="width:212px; height:60px;">
                    </div>
                    <p>{{$doctor->short_about}}</p>

                    <ul class="list-inline footer-socials mt-4">
                        @foreach ($doctor->socials as $social)
                            <li class="list-inline-item">
                                <a href="{{$social->url}}">
                                    <i class="{{$social->icon}}"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="widget mb-5 mb-lg-0">
                    <h4 class="text-capitalize mb-3">Menu</h4>
                    <div class="divider mb-4"></div>

                    <ul class="list-unstyled footer-menu lh-35">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('about')}}">About</a></li>
                        <li><a href="{{route('skills')}}">My skills</a></li>
                        <li><a href="{{route('blog.index')}}">My Blog</a></li>
                        <li><a href="{{route('contact.index')}}">Contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="widget widget-contact mb-5 mb-lg-0">
                    <h4 class="text-capitalize mb-3">Contact</h4>
                    <div class="divider mb-4"></div>

                    <div class="footer-contact-block mb-4">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-email mr-3"></i>
                            <span class="h6 mb-0"><a href="mailto:{{$doctor->email}}">{{$doctor->email}}</a></span>
                        </div>
                    </div>

                    <div class="footer-contact-block mb-4">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-phone mr-3"></i>
                            <span class="h6 mb-0"><a href="tel:{{$doctor->phone}}">{{$doctor->phone}}</a></span>
                        </div>
                    </div>

                    <div class="footer-contact-block">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-location-pin mr-3"></i>
                            <span class="h6 mb-0">{{$doctor->location}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-btm py-4 mt-5">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6">
                    <div class="copyright">
                        &copy; Designed by <a href="http://fermanli.net/" target="_blank">www.fermanli.net</a>
                    </div>
                </div>
{{--                <div class="col-lg-6">--}}
{{--                    <div class="subscribe-form text-lg-right mt-5 mt-lg-0">--}}
{{--                        <form action="#" class="subscribe">--}}
{{--                            <input type="text" class="form-control" placeholder="Your Email address">--}}
{{--                            <a href="#" class="btn btn-main-2 btn-round-full">Subscribe</a>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <a class="backtop js-scroll-trigger" href="#top">
                        <i class="icofont-long-arrow-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
