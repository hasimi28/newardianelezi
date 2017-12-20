<style>
    .scrollbar-indigo::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
        background-color: white;
        border-radius: 5px; }

    .scrollbar-indigo::-webkit-scrollbar {
        width: 6px;
        background-color: #019b69!important; }

    .scrollbar-indigo::-webkit-scrollbar-thumb {
        border-radius: 6px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
        background-color: #019b69!important; }




</style>


<header>
    <!--KODE TOP WRAP START-->
    <div class="kode_top_wrap">
        <!--CONTAINER START-->
        <div class="container">
            <!--ROW START-->
            <div class="row">
                <div class="col-md-6">
                    <!--KODE TOP INFO START-->
                    <div class="kode_top_info">
                        <ul>
                            <li><a href="#"><i class="fa fa-envelope"></i>contact@infomosque.com</a></li>
                            <li><a href="#"><i class="fa icon-technology"></i>+92 - 334 - 2797084</a></li>

                            <li>
                                <div class="dropdown">


                                    <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if ( Config::get('app.locale') == 'sq')

                                            <img src="{{ asset('css/themes/images/al.png') }}" alt="">


                                           @elseif ( Config::get('app.locale') == 'de' )

                                            <img src="{{ asset('css/themes/images/de.png') }}" alt="">
                                        @endif

                                        <span class="fa fa-angle-down"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                        <li><a href="#" class="lang" name="de"><img src="{{ asset('css/themes/images/de.png') }}" alt="">DE</a></li>
                                        <li><a href="#" class="lang" name="sq"><img src="{{ asset('css/themes/images/al.png') }}" alt="">SQ</a></li>

                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--KODE TOP INFO END-->
                </div>
                <div class="col-md-6">
                    <div class="kode_top_right_text">
                        <ul class="top_icon_fig">
                            <li><a href="#"><img src="{{ asset('css/themes/images/icon-img.png') }}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('css/themes/images/icon-img1.png') }}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('css/themes/images/icon-img2.png') }}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('css/themes/images/icon-img3.png') }}" alt=""></a></li>
                        </ul>
                        <form method="post" id="commentform" class="comment-form">
                            <div class="kf_commet_field">
                                <input placeholder="Your Keyword" name="author" type="text" value="" data-default="Name*" required>
                                <button><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--ROW END-->
        </div>
        <!--CONTAINER END-->
    </div>
    <!--KODE TOP WRAP END-->

    <!--KODE TOP LOGO WRAP START-->
    <div class="kode_top_logo_wrap" style="background-color:#019b69!important">
        <!--CONTAINER START-->
        <div class="container">
            <div class="top_logo">
                <h1><a href="#"><img src="{{ asset('css/themes/images/svgfile.svg') }}" alt="kodeforest" style="width:100px;height:100px;"><img src="{{ asset('css/themes/images/ardianelezi.png') }}" alt="kodeforest" ></a></h1>
            </div>
            <div class="top_time_circle">
                <ul>
                    <li style="font-weight:bold;border:2px solid white"><a href="#">{{trans('app_lang.imsaku')}}</a><span>{{array_get($array, 'kohet.imsaku')}}</span></li>
                    <li style="font-weight:bold;border:2px solid white"><a href="#">{{trans('app_lang.dreka')}}</a><span>{{array_get($array, 'kohet.dreka')}}</span></li>
                    <li style="font-weight:bold;border:2px solid white"><a href="#">{{trans('app_lang.ikindia')}}</a><span>{{array_get($array, 'kohet.ikindia')}}</span></li>
                    <li style="font-weight:bold;border:2px solid white"><a href="#">{{trans('app_lang.akshami')}}</a><span>{{array_get($array, 'kohet.akshami')}}</span></li>
                    <li style="font-weight:bold;border:2px solid white"><a href="#">{{trans('app_lang.jacia')}}</a><span>{{array_get($array, 'kohet.jacia')}}</span></li>
                </ul>
            </div>
        </div>
        <!--CONTAINER END-->
    </div>
    <!--KODE TOP LOGO WRAP END-->

    <!--KODE NAVIGATION WRAP START-->
    <div class="kode_navigation_wrap z-depth-2">
        <!--CONTAINER START-->
        <div class="container" >
            <div class="navigation">
                <ul>
                    <li><a class="active" href="{{url('/')}}">Home</a></li>

                    <li ><a href="#">Shkrime</a>
                        <ul class="kode scrollbar-indigo">
                            @if(count($category) > 0)
                            @foreach($category as $cat)
                            <li><a href="{{route('category.post',strtolower($cat->NameTrans('name')))}}">{{$cat->NameTrans('name')}}</a></li>
                            @endforeach
                            @endif
                        </ul>
                    </li>
                    <li><a href="#">Video Ligjerata</a>
                        <ul class="kode">
                            <li><a href="{{route('video.index')}}">Shqip</a></li>
                            <li><a href="{{route('videode.index')}}">Gjermanisht</a></li>

                        </ul>
                    </li>
                    <li><a href="#">Audio Ligjerata</a>
                        <ul class="kode">
                            <li><a href="project.html">Ramazani</a></li>
                            <li><a href="project-01.html">Namazi</a></li>
                            <li><a href="project-list.html">Haxhi</a></li>
                            <li><a href="project-detail.html">Zekati</a></li>
                        </ul>
                    </li>
                    @if(Config::get('app.locale') == 'sq')    <li><a href="{{url('/kuranishqip')}}">KuraniShqip</a></li> @endif
                    <li><a href="{{url('/vquestions')}}">Pyetjet</a></li>

                    {{--<li><a href="{{url('kuran')}}">Read Kuran</a></li>--}}
                </ul>
                <!--DL Menu Start-->
                <div id="kode-responsive-navigation" class="dl-menuwrapper">
                    <button class="dl-trigger">Open Menu</button>
                    <ul class="dl-menu">
                        <li><a class="active" href="#">Home</a>
                            <ul class="dl-submenu">
                                <li><a href="index.html">DEFULT HOME</a></li>
                                <li><a href="index-1.html">Home page 02</a></li>
                            </ul>
                        </li>
                        <li class="menu-item kode-parent-menu"><a href="about-us.html">About Us</a></li>
                        <li class="menu-item kode-parent-menu"><a href="#">Services</a>
                            <ul class="dl-submenu">
                                <li><a href="service.html">service</a></li>
                                <li><a href="service-01.html">service 01</a></li>
                                <li><a href="service02.html">service 02</a></li>
                                <li><a href="service-detail.html">service detail</a></li>
                                <li><a href="service-sidebar.html">service sidebar</a></li>
                            </ul>
                        </li>
                        <li class="menu-item kode-parent-menu"><a href="#">Projects</a>
                            <ul class="dl-submenu">
                                <li><a href="project.html">project</a></li>
                                <li><a href="project-01.html">project 01</a></li>
                                <li><a href="project-list.html">project list</a></li>
                                <li><a href="project-detail.html">project detail</a></li>
                            </ul>
                        </li>
                        <li class="menu-item kode-parent-menu"><a href="#">blog</a>
                            <ul class="dl-submenu">
                                <li><a href="blog.html">blog</a></li>
                                <li><a href="blog01.html">blog 01</a></li>
                                <li><a href="blog-detail.html">blog detail</a></li>
                                <li><a href="blog-sidebar.html">blog sidebar</a></li>
                            </ul>
                        </li>
                        <li class="menu-item kode-parent-menu"><a href="#">portfolio</a>
                            <ul class="dl-submenu">
                                <li><a href="portfolio.html">portfolio</a></li>
                                <li><a href="portfolio-01.html">portfolio 01</a></li>
                                <li><a href="portfolio-02.html">portfolio 02</a></li>
                                <li><a href="portfolio-detail.html">portfolio detail</a></li>
                            </ul>
                        </li>
                        <li class="menu-item kode-parent-menu"><a href="#">Pages</a>
                            <ul class="dl-submenu">
                                <li><a href="event.html">event</a></li>
                                <li><a href="404.html">404 page</a></li>
                                <li><a href="shop.html">shop page</a></li>
                                <li><a href="coming-soon.html">coming soon</a></li>
                                <li><a href="event-detail.html">event detail</a></li>
                                <li><a href="event-sidebar.html">event sidebar</a></li>
                                <li><a href="team-detail.html">team detail</a></li>
                            </ul>
                        </li>
                        <li><a href="contact-us.html">contact Us</a></li>
                    </ul>
                </div>
                <!--DL Menu END-->
            </div>
        </div>
        <!--CONTAINER END-->
    </div>
    <!--KODE NAVIGATION WRAP END-->
</header>