
@extends('layouts.app')

@section('head')
    <link href="{{asset('css/themes/css/sidebar-widget.css')}}" rel="stylesheet">
    <link href="{{asset('css/themes/css/small.css')}}" rel="stylesheet">
    <link href="{{asset('css/themes/css/chosen.min.css')}}" rel="stylesheet">

    <script src="{{asset('css/themes/js/jquery.tubeplayer.min.js')}}"></script>
@endsection
@section('content')

    <div class="kode_blog_madium_wrap wrap_2 padding">


    <!--CONTAINER START-->
    <div class="container">

        <!--KODE PORTFOLIO DES DES 2 START-->
        <div class="section_hdg">

            <a href="#"><img src="http://ae.app/css/themes/images/hdg-img.png" alt=""></a>
            @if((Request::segment(2) == true))  <span><i class="fa icon-building"></i></span>  <h3 style="margin-left:70px;">@foreach($cat as $c) {{$c->name}} @endforeach</h3> @else  @endif


        </div>
        <div class="row ">
            <div class="col-md-12 kode_donation_row">
                <div class="kode_donation_item ">
                    <select class="chosen-select" name="category_id" id="cat" style=" padding:10px;">
                        <option value="Select Course Name">All</option>
                        @foreach($all as $ca)

                            <option value="{{$ca->id}}" name="{{$ca->name}}" class="ops">{{$ca->name}}</option>

                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="kode_portfolio_des des_2 z-depth-2 p-2">


            @if($video->count())

            <div class="col-md-7 load" style="margin-top:30px;">
                <video id="myVideo" width="320" height="176" style="display:none;">
                    <source src="mov_bbb.mp4" type="video/mp4">
                    <source src="mov_bbb.ogg" type="video/ogg">
                    Your browser does not support HTML5 video.
                </video>
                    <iframe id="video1"  frameborder="0" height="350" style="display:none;" > </iframe>

                    <div id="player"></div>




            </div>

            <div class="col-md-5 scrollbar-indigo" style="height:400px;overflow-y:scroll;" >



                    <ul class="kode_calender_detail" id="result">

                        @foreach($video as $vid)




                        <li>




                            @if($vid->filename == 'nofile')

                                <div class="kode_calender_list">
                                    <a href="javascript:void(0);" class="mt-0 mb-1 video2 active"       id="{{$vid->youtube_id}}"    > <img src="{{asset('postimages/'.$vid->image)}}" class="new_post"></a>
                                    <div class="kode_event_text">
                                        <h6> <a href="javascript:void(0);" class="mt-0 mb-1 video2 active"    id="{{$vid->youtube_id}}" > {{$vid->title}} </a></h6>
                                        <p>Published : <span>  {{$vid->created_at->diffForHumans()}}</span></p>
                                    </div>
                                </div>
                            @else
                                <div class="kode_calender_list">
                                    <a href="javascript:void(0);" class="mt-0 mb-1 active"       id="playvideo"   onclick="playme({{$vid->filename}})"  > <img src="{{asset('postimages/'.$vid->image)}}" class="new_post"></a>
                                    <div class="kode_event_text">
                                        <h6> <a href="javascript:void(0);" class="mt-0 mb-1  active"    id="playvideo"   onclick="playme('{{$vid->filename}}')" > {{$vid->title}} </a></h6>
                                        <p>Published : <span>  {{$vid->created_at->diffForHumans()}}</span></p>
                                    </div>
                                </div>
                            @endif

                        </li>
                        @endforeach

                    </ul>

                <div class="kode_project_share">

                    <!--KODE SOCIAL SHARE START-->

                    <!--KODE SOCIAL SHARE END-->
                </div>
            </div>
            @else
                <div style="background-color:#019b69!important;color:white;font-size:22px;padding:15px">Nuk ka asnje video !</div>
            @endif
        </div>

        <!--KODE PORTFOLIO DES DES 2 END-->


        <!--KODE PAGINATION LIST START-->

        <!--KODE PAGINATION LIST END-->
    </div>
    <!--CONTAINER END-->
</div>

    @endsection

@section('js')
    <script>
        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);



        video_id = $('.video2').attr('id') ;


        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {

                videoId: video_id,
                events: {

                    'onStateChange': onPlayerStateChange
                }
            });
        }

        // 4. The API will call this function when the video player is ready.
        function onPlayerReady(event) {
            event.target.playVideo();
        }

        // 5. The API calls this function when the player's state changes.
        //    The function indicates that when playing a video (state=1),
        //    the player should play for six seconds and then stop.
        var done = false;
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
                setTimeout(stopVideo, 6000);
                done = true;
            }
        }




        $('.video2').click(function(){
            $('#player').show();
            $('#video1').hide();
            document.getElementById("video1").src = '';
            video_id = $(this).attr('id') ;


            player.loadVideoById(video_id);
        });


        // 3. This function creates an <iframe> (and YouTube player)


        $( ".chosen-select").on('change',function(e)
        {
            $("#result").html('');




            var category_id = $(this).val();

            var catname = $(this).find('option:selected').attr("name");
            var cat_name = catname.toLowerCase();


            var urla = "{{url('video')}}/" + cat_name + "" ;
            window.location.href = urla;


            {{--$.ajax({--}}
                {{--headers: {--}}
                    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                {{--},--}}
                {{--url     : '{{url("findsq")}}',--}}
                {{--type    : 'GET',--}}
                {{--dataType : 'json',--}}
                {{--data    : {category_id:category_id},--}}
                {{--success: function(data) {--}}

                    {{--var urla = "{{url('video')}}/" + cat_name + "" ;--}}
                    {{--window.location.href = urla;--}}


              {{--$.each(data.video, function(i, object) {--}}

              {{--$("#result").append('<li><div class="kode_calender_list"> <a href="javascript:void(0);" class="t-0 mb-1 video2 active" id='+object['title']+'> <img src="{{asset("postimages")}}/'+object['image']+'" class="new_post" ></a><div class="kode_event_text">     <h6> <a href="javascript:void(0);"  class="mt-0 mb-1 video2 active" id='+object['youtube_id']+'> '+object['title']+' </a></h6>  <p>Published : <span>  '+object['created_at']+' </span></p> </div></div></li>');--}}

                    {{--});--}}



                {{--},--}}

                {{--error: function(data){--}}
                    {{--var errors = data.responseJSON;--}}

                    {{--$.each(errors, function( index, value ) {--}}
                        {{--info.find('ul').append('<li>' + value + '</li>');--}}
                        {{--info.css('background-color','#F44336');--}}
                        {{--$('.load').html('');--}}
                    {{--});--}}
                {{--}--}}

            {{--});--}}
        });


        function playme(filename) {

            $('#player').hide();
            $('#video1').show();
            document.getElementById("video1").src = '{{asset('videoligjerata')}}/' + filename + "";
        }

    </script>
    @endsection