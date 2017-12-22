
<style>

    @media (max-width: 480px) {

        .new_post{

            width:100%;
        }

    }

    @media (min-width: 760px) {

        .new_post{

            width:25%;
        }


    }
    .new_post2 img{

        height:70px;

    }
    .new_post2{

        width:25%;

    }
</style>
<div class="kode_blog_wrap">
    <!--CONTAINER START-->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="kode_blog_row">
                    <!--SECTION HDG START-->
                    <div class="section_hdg">
                        <a href="#"><img src="{{asset('css/themes/images/hdg-img.png')}}" alt=""></a>
                        <h3>New Post</h3>
                        <span><i class="fa icon-building"></i></span>
                    </div>
                    <!--SECTION HDG END-->
                    <div class="kode_blog_list">
                        <ul>
                            @foreach($new_post as $p)
                            <li>
                                <div class="kode_blog_fig">
                                    <div class=" new_post">
                                    <figure class="them_overlay">
                                        @if(file_exists('postimages/'.$p->image ))
                                            <img src="{{asset('postimages/'.$p->image)}}" alt="">
                                        @else
                                            <img src="{{asset('css/themes/extra-images/blog-grid1.jpg')}}" alt="">
                                        @endif
                                        <a class="plus_icon hvr-ripple-out"  href="{{url('fullpost',$p->TextTrans('slug'))}}"><i class="fa icon-arrows-1"></i></a>
                                    </figure></div>
                                    <div class="kode_blog_text">
                                        <ul class="kode_meta">
                                            <li><a href="#"><i class="fa fa-calendar"></i>{{$p->created_at->diffForHumans()}}</a></li>
                                            <li><a href="#"><i class="fa fa-user"></i>By Admin</a></li>
                                        </ul>
                                        <h4> <a href="{{url('fullpost',$p->TextTrans('slug'))}}">{{$p->TextTrans('title')}}</a></h4>
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
                </div>
            </div>
            <div class="col-md-4">
                <div class="kode_event_row">
                    <!--SECTION HDG START-->
                    <div class="section_hdg">
                        <a href="#"><img src="{{asset('css/themes/images/hdg-img.png')}}" alt=""></a>
                        <h3>Kur'an</h3>
                        <span><i class="fa icon-building"></i></span>
                    </div>
                    <!--SECTION HDG END-->
                    <!--KODE EVENT DES START-->
                    <div class="kode_event_des">
                        <div class="koed_event_timer">
                            <iframe src="https://archive.org/embed/Mishary_Alafasy_Quran&playlist=1" width="500" height="400" frameborder="0" webkitallowfullscreen="true" mozallowfullscreen="true" allowfullscreen></iframe>                            <li>

                        </div>
                        <ul class="kode_calender_detail">


                        </ul>
                    </div>


                    <h4 class="sidebar_title">Ligjeratat</h4>
                    <div class="koed_event_timer">
                        <figure class="them_overlay">
                            <img src="{{asset('css/themes/extra-images/timer.jpg')}}" alt="">
                            <figcaption>
                                <h5>Ligjerata E Radhes : Koha E Mbetur</h5>
                                <ul class="countdown">
                                    <li>
                                        <span class="days"> {{$days}} </span>
                                        <p class="">Dite</p>
                                    </li>
                                    <li>
                                        <span class="hours">{{$hours}}</span>
                                        <p class="">Ore</p>
                                    </li>
                                    <li>
                                        <span class="minutes">{{$minutes}}</span>
                                        <p class="">Min</p>
                                    </li>
                                    <li>
                                        <span class="seconds">00</span>
                                        <p class="">Sec</p>
                                    </li>
                                </ul>
                            </figcaption>
                        </figure>
                    </div>
                    <ul class="kode_calender_detail"  style="background: #efefef;">
                        @foreach($event as $e)
                            <li>
                                <div class="kode_calender_list">
                                    <div class="new_post2">
                                    <figure class="them_overlay">
                                   <img src="{{asset('postimages/'.$e->image)}}">
                                    </figure>
                                    </div>
                                    <div class="kode_event_text">

                                        <h6><a href="#">Tema : {{$e->NameTrans('ti')}} </a></h6>
                                        <p><b>  {{$e->datetime->formatLocalized('%A')}} <span> {{$e->datetime->formatLocalized('%d %B %Y')}} </span></b> </p>
                                        <p> <b> Ora :  <span>{{$e->datetime->format('H:i:s')}}  </span>  </b></p>

                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>

                    <!--KODE EVENT DES END-->
                </div>
            </div>
        </div>
    </div>
    <!--CONTAINER END-->
</div>