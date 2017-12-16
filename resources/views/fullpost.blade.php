@extends('layouts.app')

@section('head')


    <link href="{{asset('css/themes/css/mycss.css')}}" rel="stylesheet">
    <meta property="fb:admins" content="{275612799576215}" />
@section('title')
    @foreach($fullpost as $post) {{$post->TextTrans('title')}} @endforeach
@endsection
@endsection

@section('content')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/sq_AL/sdk.js#xfbml=1&version=v2.11&appId=275612799576215';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>



    <style>@media (min-width: 760px) {

            .full_post_img{

                height:400px;
                width:100%;
            }

        }

        @media (max-width: 480px) {

            .new_post{

                width:100%;
            }

        }

        @media (min-width: 760px) {

            .new_post{

                width:30%;
            }

        }</style>

    @foreach($fullpost as $post)
    <div class="kode_blog_madium_wrap detail padding">
        <!--CONTAINER START-->
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!--KODE BLOG DETAIL ROW START-->
                    <div class="kode_blog_detail_row">
                        <!--KODE BLOG DETAIL DES START-->
                        <div class="kode_blog_detail_des ">
                            <figure class="them_overlay full_post_img">
                                <img src="{{asset('postimages/'.$post->image)}}" alt="">
                            </figure>
                            <div class="kode_blog_detail_text">
                                <h3><a href="#">{{$post->TextTrans('title')}}</a></h3>
                                <ul class="kode_meta meta_2">
                                    <li><a href="#"><i class="fa fa-clock-o"></i>{{$post->created_at->diffForHumans()}}</a></li>
                                    <li><a href="{{url('postwithcat',$post->categories->id)}}"><i class="fa fa-book" aria-hidden="true"></i>{{$post->categories->name_sq}}</a></li>
                                    <li><a href="#"><i class="fa fa-comment"></i>Leave Comment</a></li>
                                </ul>
                            </div>
                            <p>{!! $post->TextTrans('desc') !!}</p>
                        </div>




                        <!--KODE SOCIAL SHARE START-->
                        <div class="kode_social_share">
                            <a href="#"><i class="fa fa-share-alt"></i>Share This Post</a>
                            <ul class="social_meta">
                                <li><a class="hvr-ripple-out" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="hvr-ripple-out" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="hvr-ripple-out" href="#"><i class="fa fa-tumblr"></i></a></li>
                            </ul>
                            <!--KODE PAGINATION START-->
                            <div class="kode_pagination">
                                @if(count($prev))  <a class="prve" href="{{url('fullpost/'.$prev->TextTrans('slug'))}}"><i class="fa fa-arrow-left"></i>Previous</a> @endif
                               @if(count($next)) <a class="next" href="{{url('fullpost/'.$next->TextTrans('slug'))}}" >Next<i class="fa fa-arrow-right"></i></a> @endif
                            </div>
                            <!--KODE PAGINATION END-->
                        </div>
                        <!--KODE SOCIAL SHARE END-->
                        <!--KODE BLOG DETAIL DES END-->
                        <blockquote class="blog_quote">
                            Tags :
                            @foreach($post->tags as $tag) <a href="{{url('postwtag',$tag->id)}}">   <i class="fa fa-tags"></i> {{$tag->NameTrans('name')}}</a>  @endforeach


                        </blockquote>
                        <!--KODE COMMENTS MARGIN START-->

                        @endforeach
                        <!--KODE COMMENTS MARGIN END-->
                        <div class="fb-comments" data-href="https://ae.app" data-numposts="5"></div>                        <!--KODE COMMENTS MARGIN START-->
                        {{--<div class="kode_comments margin">--}}
                            {{--<h4 class="comment_title">Leave Comment</h4>--}}
                            {{--<form method="post" id="commentform" class="comment-form">--}}
                                {{--<div class="kode-left-comment-sec">--}}
                                    {{--<div class="kf_commet_field">--}}
                                        {{--<input placeholder="Your Name" name="author" type="text" value="" data-default="Name*" size="30" required="">--}}
                                    {{--</div>--}}
                                    {{--<div class="kf_commet_field">--}}
                                        {{--<input placeholder="Your Email" name="email" type="text" value="" data-default="Email*" size="30" required="">--}}
                                    {{--</div>--}}


                                {{--</div>--}}
                                {{--<div class="kode_textarea">--}}
                                    {{--<textarea placeholder="Your Comments" name="comment"></textarea>--}}
                                {{--</div>--}}
                                {{--<p class="form-submit"><input name="submit" type="submit" class="medium_btn theme_color_bg btn_hover" value="Submit Now"></p>--}}

                            {{--</form>--}}
                        {{--</div>--}}
                        <!--KODE COMMENTS MARGIN END-->

                        <!--ROW START-->
                        <div class="row">
                            <div class="kode_blog_detail_post">
                                <div class="col-md-12">
                                    <!--SECTION HDG START-->
                                    <div class="section_hdg">
                                        <h3>Recent Posts</h3>
                                        <span><i class="fa icon-building"></i></span>
                                    </div>
                                    <!--SECTION HDG END-->
                                </div>
                                @foreach($postlikethis as $p)
                                <div class="col-md-6">
                                    <div class="kode_blog_des des_2">
                                        <figure class="them_overlay">
                                            <img src="{{asset('postimages/'.$p->image)}}" alt="">
                                            <a  class="expand_btn btn_hover2" href="{{url('blog.post'.$p->TextTrans('slug'))}}"><i class="fa icon-arrows-1"></i></a>
                                        </figure>
                                        <div class="kode_blog_text">
                                            <h4><a href="{{route('blog.post',$p->TextTrans('slug'))}}"><span>{{$p->TextTrans('title')}}</span></a></h4>
                                            <div class="kode_blog_caption">
                                                <ul class="kode_meta meta_2">
                                                    <li><a href="#"><i class="fa fa-clock-o"></i>{{$p->created_at->diffForHumans()}}</a></li>
                                                    <li><a href="{{url('/category',strtolower($p->categories->NameTrans('name')))}}"><i class="fa fa-book"></i>{{$p->categories->NameTrans('name')}}</a></li>
                                                </ul>
                                                <a class="share_link hvr-ripple-out" href="#"><i class="fa fa-share-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        <!--ROW END-->
                    </div>
                    <!--KODE BLOG DETAIL ROW END-->
                </div>
                <div class="col-md-4">
                    <!--SIDEBAR WIDGET START-->
                    <div class="sidebar-widget">
                        <!--KODE SEARCH MARGIN START-->
                        <div class="kode_search margin">
                            <form method="post" class="comment-form">
                                <div class="kf_commet_field">
                                    <input placeholder="Search Here" name="author" type="text" value="" data-default="Name*" size="30" required="">
                                    <button><i class="fa fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                        <!--KODE SEARCH MARGIN END-->

                        <!--SIDEBAR CATEGORIES MARGIN START-->

                        <div class="siderbar_categories margin sidebar_bg">
                            <h4 class="sidebar_title">Categories</h4>
                            <ul class="categories_detail">
                                @foreach($category5 as $cat) <li><a href="{{url('/category',strtolower($cat->NameTrans('name')))}}">{{$cat->NameTrans('name')}}</a></li>@endforeach
                            </ul>
                        </div>

                        <!--SIDEBAR CATEGORIES MARGIN END-->

                        <!--SIDEBAR CATEGORIES RECENT NEWS MARGIN START-->

                            <div class="siderbar_categories recent_news margin sidebar_bg">
                                <h4 class="sidebar_title">New Post</h4>

                                <ul class="kode_calender_detail">
                                    @foreach($new_post as $pos)
                                        <li>

                                            <div class=" kode_calender_list new_post">
                                                <figure class=" them_overlay">
                                                    <a href="#"><img src="{{asset('postimages/'.$pos->image)}}" alt=""></a>
                                                </figure></div>

                                            <div class="kode_event_text">
                                                <h6><a href="{{route('blog.post',$pos->TextTrans('slug'))}}">{{$pos->TextTrans('title')}}</a></h6>
                                                <ul class="kode_meta">
                                                    <li><a href="#"><i class="fa fa-clock-o"></i>{{$pos->created_at->diffForHumans()}}</a></li>
                                                </ul>
                                            </div>

                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        <!--SIDEBAR CATEGORIES RECENT NEWS MARGIN END-->

                        <!--SIDEBAR ADD MARGIN START-->
                        <div class="sidebar_add margin">
                            <figure class="them_overlay">
                                <a href="#"><img src="extra-images/recent-news2.jpg"></a>
                                <figcaption>
                                    <h3>Muslim Refuges</h3>
                                    <h2>360 x 315</h2>
                                    <h4>Place Your </h4>
                                    <h5>Ad Here</h5>
                                    <a class="medium_btn theme_color_bg btn_hover2 hvr-ripple-out" href="#">Donate Now</a>
                                </figcaption>
                            </figure>
                        </div>
                        <!--SIDEBAR ADD MARGIN END-->

                        <!--SIDEBAR CATEGORIES ARCHIVE START-->
                        <div class="siderbar_categories archive sidebar_bg">
                            <h4 class="sidebar_title">Blog Archieve</h4>
                            <ul class="categories_detail">
                                <li><a href="#">March 2017</a></li>
                                <li><a href="#">April 2017</a></li>
                                <li><a href="#">May 2017</a></li>
                                <li><a href="#">June 2017</a></li>
                                <li><a href="#">July 2017</a></li>
                                <li><a href="#">August 2017</a></li>
                            </ul>
                        </div>
                        <!--SIDEBAR CATEGORIES ARCHIVE END-->
                    </div>
                    <!--SIDEBAR WIDGET END-->
                </div>
            </div>
        </div>
        <!--CONTAINER END-->
    </div>

@endsection