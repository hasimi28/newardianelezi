@extends('layouts.app')
@section('head')

    <link href="{{asset('css/themes/css/sidebar-widget.css')}}" rel="stylesheet">


    @section('title')@foreach($cat as $c){{$c->NameTrans('name')}} @endforeach
    @endsection
@endsection
@section('content')
<style>

    @media (max-width: 480px) {

        .new_post{

            width:100%;
        }

    }

    @media (min-width: 760px) {

        .new_post{

            width:30%;
        }

    }
</style>
    <div class="kode_sab_banner_wrap them_overlay">
        <!--CONTAINER START-->
        <div class="container">
            <div class="sab_banner_text">
                <h2>@foreach($cat as $c){{$c->NameTrans('name')}} @endforeach</h2>
                <ul class="breadcrumbs">
                    <li><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
                    <li><strong>{{$c->NameTrans('name')}}</strong></li>
                </ul>
            </div>
        </div>
        <!--CONTAINER END-->
    </div>

    <div class="kode_blog_madium_wrap wrap_2 padding">
        <!--CONTAINER START-->
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        @if($posts->count())
                            @foreach($posts as $p)
                        <div class="col-md-6" style="height:600px;">
                            <div class="kode_blog_des des_2">
                                <figure class="them_overlay">

                                    @if(file_exists('postimages/'.$p->image ))
                                        <img src="{{asset('postimages/'.$p->image)}}" alt="">
                                    @else
                                        <img src="{{asset('css/themes/extra-images/blog-grid1.jpg')}}" alt="">
                                    @endif



                                    <a class="expand_btn btn_hover2" href="{{url('blog.post',$p->TextTrans('slug'))}}"><i class="fa icon-arrows-1"></i></a>
                                </figure>
                                <div class="kode_blog_text">
                                    <h4><a href="{{url('fullpost',$p->TextTrans('slug'))}}"><span>{{$p->TextTrans('title')}}</span></a></h4>
                                    <div class="kode_blog_caption">

                                        <p>{!! str_limit($p->TextTrans('desc'), 200) !!}</p>
                                        <ul class="kode_meta meta_2">
                                            <li><a href="#"><i class="fa fa-clock-o"></i>{{$p->created_at->diffForHumans()}}</a></li>

                                        </ul>
                                        <a class="share_link hvr-ripple-out" href="#"><i class="fa fa-share-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                                <!-- Load Facebook SDK for JavaScript -->

                            @endforeach

                            @else
                           <div style="background-color:#019b69!important;color:white;font-size:22px;padding:15px">Nuk ka asnje postim !</div>
                            @endif

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
                        <div class="siderbar_categories margin">
                            <h4 class="sidebar_title">Categories</h4>
                            <ul class="categories_detail">
                @foreach($category5 as $cat) <li><a href="{{url('/category',strtolower($cat->NameTrans('name')))}}">{{$cat->NameTrans('name')}}</a></li>@endforeach
                            </ul>
                        </div>
                        <!--SIDEBAR CATEGORIES MARGIN END-->

                        <!--SIDEBAR CATEGORIES RECENT NEWS START-->
                        <div class="siderbar_categories recent_news">
                            <h4 class="sidebar_title">New Post</h4>

                            <ul class="kode_calender_detail">
                                @foreach($new_post as $pos)
                                <li>

                                    <div class=" kode_calender_list new_post">
                                        <figure class=" them_overlay">
                                            <a href="#"><img src="{{asset('postimages/'.$pos->image)}}" alt=""></a>
                                        </figure></div>

                                        <div class="kode_event_text">
                                            <h6><a href="{{url('fullpost',$pos->TextTrans('slug'))}}">{{$pos->TextTrans('title')}}</a></h6>
                                            <ul class="kode_meta">
                                                <li><a href="#"><i class="fa fa-clock-o"></i>{{$pos->created_at->diffForHumans()}}</a></li>
                                            </ul>
                                        </div>

                                </li>
                            @endforeach
                            </ul>
                        </div>
                        <!--SIDEBAR CATEGORIES RECENT NEWS END-->
                    </div>
                    <!--SIDEBAR WIDGET END-->
                </div>
                <!--KODE PAGINATION LIST START-->
                @if($posts->count())

                    {{ $posts->links('vendor.pagination.bootstrap-4') }}

                @endif
                <!--KODE PAGINATION LIST END-->
            </div>
        </div>
        <!--CONTAINER END-->
    </div>

@endsection