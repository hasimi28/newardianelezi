@extends('layouts.app')

@section('head')
    <link href="{{asset('css/themes/css/sidebar-widget.css')}}" rel="stylesheet">

@endsection
@section('content')
<style>

    .lista{

        background-color: #019b69!important;
        color:white;
    }

    .lista a{

        color:white;
    }
</style>

    <div class="kode_blog_madium_wrap wrap_2 padding">
        <!--CONTAINER START-->
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="siderbar_categories margin">
                        <div class="section_hdg">
                            <a href="#"><img src="http://ae.app/css/themes/images/hdg-img.png" alt=""></a>
                            <span><i class="fa icon-building"></i></span>  <h3 style="margin-left:70px;">Kategorite</h3>

                        </div>



                            @foreach($videocategory as $cat)
                            <ul class="categories_detail z-depth-1-half mt-2 lista">

                                <div class="kode_event_speaker_text">
                                    <h6><a href="{{route('videode.show',strtolower($cat->name))}}">{{$cat->name}}</a></h6>
                                    <p> @if(!empty($cat->video_de)){{$cat->video_de->count()}} @else 0 @endif Video</p>
                                </div>

                            </ul>
                                @endforeach


                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="kode_blog_des des_2">
                                <figure class="them_overlay">
                                    <img src="extra-images/blog-grid1.jpg" alt="">
                                    <a data-rel="prettyPhoto" class="expand_btn btn_hover2" href="extra-images/blog-grid2.jpg"><i class="fa icon-arrows-1"></i></a>
                                </figure>
                                <div class="kode_blog_text">
                                    <h4><a href="#"><span>Students Studying In Our</span>Madrasa</a></h4>
                                    <div class="kode_blog_caption">
                                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. tortor quam...</p>
                                        <ul class="kode_meta meta_2">
                                            <li><a href="#"><i class="fa fa-clock-o"></i>April 11 , 2017</a></li>
                                            <li><a href="#"><i class="fa fa-user"></i>By Admin</a></li>
                                        </ul>
                                        <a class="share_link hvr-ripple-out" href="#"><i class="fa fa-share-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="kode_blog_des des_2">
                                <figure class="them_overlay">
                                    <img src="extra-images/blog-grid3.jpg" alt="">
                                    <a data-rel="prettyPhoto" class="expand_btn btn_hover2" href="extra-images/blog-grid3.jpg"><i class="fa icon-arrows-1"></i></a>
                                </figure>
                                <div class="kode_blog_text">
                                    <h4><a href="#"><span>Students Studying In Our</span>Madrasa</a></h4>
                                    <div class="kode_blog_caption">
                                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. tortor quam...</p>
                                        <ul class="kode_meta meta_2">
                                            <li><a href="#"><i class="fa fa-clock-o"></i>April 11 , 2017</a></li>
                                            <li><a href="#"><i class="fa fa-user"></i>By Admin</a></li>
                                        </ul>
                                        <a class="share_link hvr-ripple-out" href="#"><i class="fa fa-share-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="kode_blog_des des_2">
                                <figure class="them_overlay">
                                    <img src="extra-images/blog-grid4.jpg" alt="">
                                    <a data-rel="prettyPhoto" class="expand_btn btn_hover2" href="extra-images/blog-grid4.jpg"><i class="fa icon-arrows-1"></i></a>
                                </figure>
                                <div class="kode_blog_text">
                                    <h4><a href="#"><span>Students Studying In Our</span>Madrasa</a></h4>
                                    <div class="kode_blog_caption">
                                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. tortor quam...</p>
                                        <ul class="kode_meta meta_2">
                                            <li><a href="#"><i class="fa fa-clock-o"></i>April 11 , 2017</a></li>
                                            <li><a href="#"><i class="fa fa-user"></i>By Admin</a></li>
                                        </ul>
                                        <a class="share_link hvr-ripple-out" href="#"><i class="fa fa-share-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="kode_blog_des des_2">
                                <figure class="them_overlay">
                                    <img src="extra-images/blog-grid5.jpg" alt="">
                                    <a data-rel="prettyPhoto" class="expand_btn btn_hover2" href="extra-images/blog-grid5.jpg"><i class="fa icon-arrows-1"></i></a>
                                </figure>
                                <div class="kode_blog_text">
                                    <h4><a href="#"><span>Students Studying In Our</span>Madrasa</a></h4>
                                    <div class="kode_blog_caption">
                                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. tortor quam...</p>
                                        <ul class="kode_meta meta_2">
                                            <li><a href="#"><i class="fa fa-clock-o"></i>April 11 , 2017</a></li>
                                            <li><a href="#"><i class="fa fa-user"></i>By Admin</a></li>
                                        </ul>
                                        <a class="share_link hvr-ripple-out" href="#"><i class="fa fa-share-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

                        <!--SIDEBAR CATEGORIES MARGIN START-->

                        <!--SIDEBAR CATEGORIES MARGIN END-->

                        <!--SIDEBAR CATEGORIES RECENT NEWS START-->
                        <div class="siderbar_categories recent_news">
                            <h4 class="sidebar_title">Recent news</h4>
                            <ul class="kode_calender_detail">
                                <li>
                                    <div class="kode_calender_list">
                                        <figure class="them_overlay">
                                            <a href="#"><img src="extra-images/recent-news.jpg" alt=""></a>
                                        </figure>
                                        <div class="kode_event_text">
                                            <h6><a href="#">Our New Mosque in Lahore</a></h6>
                                            <ul class="kode_meta">
                                                <li><a href="#"><i class="fa fa-clock-o"></i>April 11 , 2017</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="kode_calender_list">
                                        <figure class="them_overlay">
                                            <a href="#"><img src="extra-images/recent-news1.jpg" alt=""></a>
                                        </figure>
                                        <div class="kode_event_text">
                                            <h6><a href="#">Our New Mosque in Lahore</a></h6>
                                            <ul class="kode_meta">
                                                <li><a href="#"><i class="fa fa-clock-o"></i>April 11 , 2017</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="kode_calender_list">
                                        <figure class="them_overlay">
                                            <a href="#"><img src="extra-images/recent-news2.jpg" alt=""></a>
                                        </figure>
                                        <div class="kode_event_text">
                                            <h6><a href="#">Our New Mosque in Lahore</a></h6>
                                            <ul class="kode_meta">
                                                <li><a href="#"><i class="fa fa-clock-o"></i>April 11 , 2017</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--SIDEBAR CATEGORIES RECENT NEWS END-->
                    </div>
                    <!--SIDEBAR WIDGET END-->
                </div>
                <!--KODE PAGINATION LIST START-->

                <!--KODE PAGINATION LIST END-->
            </div>
        </div>
        <!--CONTAINER END-->
    </div>


@endsection

     @section('js')

     @endsection