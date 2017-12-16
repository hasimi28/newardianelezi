@extends('layouts.app')


@section('content')
<style>@media (max-width: 480px) {


        #them{

           width:100%;height:auto;
        }

    }

    @media (min-width: 760px) {


        #them{

            width:170px;height:auto;
        }

    }</style>
    <div class="kode_event_wrap">
        <!--CONTAINER START-->
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="kode_blog_list">
                        @if($tags->count())
                        <ul>
                            @foreach($post as $pos)
                            <li>

                                <div class="kode_blog_fig post_img">

                                    <figure class="them_overlay them" id="them">
                                        <img src="{{asset('postimages/'.$pos->image)}}"   alt="" class="">
                                        <a class="plus_icon"  href="{{url('blog.post',$pos->TextTrans('slug'))}}"><i class="fa icon-arrows-1"></i></a>
                                    </figure>

                                    <div class="kode_blog_text">
                                        <ul class="kode_meta">
                                            <li><a href="javascript:void(0)"><i class="fa fa-calendar"></i>{{$pos->created_at->diffForHumans()}}</a></li>
                                            <li><a href="{{url('/category',strtolower($pos->categories->NameTrans('name')))}}"><i class="fa fa-book"></i>{{$pos->categories->NameTrans('name')}}</a></li>
                                        </ul>
                                        <a href="{{url('blog.post',$pos->TextTrans('slug'))}}"><h5>{{$pos->TextTrans('title')}}</h5></a>
                                        <ul class="kode_meta meta_2">
                                            <li><a href="#"><i class="fa fa-comments"></i>23 Comments</a></li>
                                            <li><a href="#"><i class="fa fa-heart"></i>654 Likes</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                    <!--KODE PAGINATION LIST START-->
                    @if($post->count())

                        {{$post->links('vendor.pagination.bootstrap-4') }}

                    @endif
                    @else
                        <div style="background-color:#019b69!important;color:white;font-size:22px;padding:15px">Nuk ka asnje postim !</div>
                    @endif

                    <!--KODE PAGINATION LIST END-->
                </div>
                <div class="col-md-4">
                    <!--SIDEBAR WIDGET START-->
                    <div class="sidebar-widget">
                        <!--KODE SEARCH MARGIN START-->
                        <div class="kode_search margin">
                            <form method="post" id="commentform" class="comment-form">
                                <div class="kf_commet_field">
                                    <input placeholder="Search Here" name="author" type="text" value="" data-default="Name*" size="30" required="">
                                    <button><i class="fa fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                        <!--KODE SEARCH MARGIN END-->

                        <div class="kode_coming_event margin">
                            <h4 class="sidebar_title">Up Coming Events</h4>
                            <div class="coming-event-slide">
                                <div>
                                    <div class="kode_coming_fig">
                                        <figure>
                                            <img src="{{asset('css/themes/extra-images/coming-event.jpg')}}" alt="">
                                        </figure>
                                        <div class="kode_coming_event_text">
                                            <h5><a href="#">Protest Against Refuges Law</a></h5>
                                            <a href="#"><i class="fa fa-map-marker"></i>Madrid Spain</a>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="kode_coming_fig">
                                        <figure>
                                            <img src="{{asset('css/themes/extra-images/coming-event1.jpg')}}" alt="">
                                        </figure>
                                        <div class="kode_coming_event_text">
                                            <h5><a href="#">Protest Against Refuges Law</a></h5>
                                            <a href="#"><i class="fa fa-map-marker"></i>Madrid Spain</a>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="kode_coming_fig">
                                        <figure>
                                            <img src="{{asset('css/themes/extra-images/coming-event1.jpg')}}" alt="">
                                        </figure>
                                        <div class="kode_coming_event_text">
                                            <h5><a href="#">Protest Against Refuges Law</a></h5>
                                            <a href="#"><i class="fa fa-map-marker"></i>Madrid Spain</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--SIDEBAR ADD MARGIN START-->
                        <div class="sidebar_add margin">
                            <figure class="them_overlay">
                                <a href="#"><img src="{{asset('css/themes/extra-images/recent-news2.jpg')}}" alt=""></a>
                                <figcaption>
                                    <h3>Muslim Refuges</h3>
                                    <h2>360 x 315</h2>
                                    <h4>Place Your </h4>
                                    <h5>Ad Here</h5>
                                    <a class="medium_btn theme_color_bg btn_hover2" href="#">Donate Now</a>
                                </figcaption>
                            </figure>
                        </div>
                        <!--SIDEBAR ADD MARGIN END-->

                        <!--KODE EVENT DES START-->
                        <div class="kode_event_des">
                            <h4 class="sidebar_title">Featured Event</h4>
                            <div class="koed_event_timer">
                                <figure class="them_overlay">
                                    <img src="{{asset('css/themes/extra-images/timer.jpg')}}" alt="">
                                    <figcaption>
                                        <h5>NExt Event In :</h5>
                                        <ul class="countdown">
                                            <li>
                                                <span class="days">52</span>
                                                <p class="">Days</p>
                                            </li>
                                            <li>
                                                <span class="hours">19</span>
                                                <p class="">HRS</p>
                                            </li>
                                            <li>
                                                <span class="minutes">85</span>
                                                <p class="">Mins</p>
                                            </li>
                                            <li>
                                                <span class="seconds">96</span>
                                                <p class="">Secs</p>
                                            </li>
                                        </ul>
                                    </figcaption>
                                </figure>
                            </div>
                            <ul class="kode_calender_detail">
                                <li>
                                    <div class="kode_calender_list">
                                        <span>23 <i>April</i></span>
                                        <div class="kode_event_text">
                                            <h6><a href="#">Awarness Of Islam EventAt Monday</a></h6>
                                            <p>Sunday <span>09 : 45 a.m</span> to <span>9:30 p.m</span></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="kode_calender_list">
                                        <span>23 <i>April</i></span>
                                        <div class="kode_event_text">
                                            <h6><a href="#">Awarness Of Islam EventAt Monday</a></h6>
                                            <p>Sunday <span>09 : 45 a.m</span> to <span>9:30 p.m</span></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="kode_calender_list">
                                        <span>23 <i>April</i></span>
                                        <div class="kode_event_text">
                                            <h6><a href="#">Awarness Of Islam EventAt Monday</a></h6>
                                            <p>Sunday <span>09 : 45 a.m</span> to <span>9:30 p.m</span></p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--KODE EVENT DES END-->

                    </div>
                    <!--SIDEBAR WIDGET END-->
                </div>
            </div>
        </div>
        <!--CONTAINER END-->
    </div>
@endsection