<header>
    <div class="header-top-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <ul class="top-bar-info list-inline-item pl-0 mb-0">
                        <li class="list-inline-item"><a href="mailto:{{$doctor->email}}"><i
                                    class="icofont-support-faq mr-2"></i>{{$doctor->email}}</a></li>
                        <li class="list-inline-item"><i class="icofont-location-pin mr-2"></i>
                            {{$doctor->location}}
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="text-lg-right top-right-bar mt-2 mt-lg-0">
                        <a href="tel:+23-345-67890">
                            <span>Call Now : </span>
                            <a href="tel:{{$doctor->phone}}"><span class="h4">{{$doctor->phone}}</span></a>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navigation" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{asset($doctor->logo??'frontend/images/logo/default.png')}}" alt="{{$doctor->fullname()}}" class="img-fluid" style="width:212px; height:60px;">
            </a>

            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain"
                    aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icofont-navigation-menu"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarmain">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('about')}}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('skills')}}">My skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('blog.index')}}">My Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('contact.index')}}">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
