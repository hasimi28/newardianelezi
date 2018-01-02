@extends('backend.adm_master')

@section('head')
<script src="{{asset('css/themes/js/jquery.tubeplayer.min.js')}}"></script>
@endsection

@section('content')

    <div class="page-title">
        <div>
            <h1><i class="fa fa-edit"></i> Form Components</h1>
            <p>Bootstrap default form components</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Forms</li>
                <li><a href="#">Edit Video</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="col-lg-10 col-md-offset-1">
                        <div class="well bs-component">
                            {{ Form::model($video,['route' => ['videomanager.update',$video->id], 'method' => 'put','class'=>'form-horizontal','files'=>true]) }}
                                {{ csrf_field() }}
                                <input type='hidden' name='_method' value='PUT'>
                                <fieldset>
                                    <legend>Edit Video</legend>
                                    <div class="form-group">
                                        {{ Form::label('category', 'Kategoria', ['class' => 'col-lg-2 control-label','for'=>'select']) }}
                                        <div class="col-lg-10">
                                            {{ Form::select('video__category_id', $categories,null, ['class' => 'form-control','id'=>'select'])  }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputEmail">Titulli Videos</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" name="title" id="email" type="text" value="{{$video->title}}">
                                        </div>
                                    </div>



                                    @if($video->filename == 'nofile')
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputPassword">ID Youtube Video</label>
                                        <div class="col-lg-10" >
                                            <input class="form-control youtube"  type="text" name="youtube_id" value="{{$video->youtube_id}}">
                                        <br>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputPassword"> Video</label>
                                        <div class="col-lg-10" >
                                            <div id="player"></div>
                                            <br>

                                        </div>
                                    </div>

                                    @else
                                        <div class="form-group upload">

                                            <label class="col-lg-2 control-label" for="name">New Video File</label>
                                            <div class="col-lg-10">
                                                <input type="file" name="video"  class="btn btn-primary btn-file">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="inputPassword"> Video</label>
                                            <div class="col-lg-10" >



                                                <input class="form-control video"  type="hidden"  value="{{$video->filename}}">
                                                <iframe id="video1"  frameborder="0" height="350" style="width:50%;" > </iframe>
                                                <br>

                                            </div>
                                        </div>





                                    @endif


                                    <div class="form-group">

                                        <label class="col-lg-2 control-label" for="name">Video Images</label>
                                        <div class="col-lg-10">
                                            <input type="file" name="image" id="profile-img" class="btn btn-primary btn-file"> <img src="{{asset('postimages/'.$video->image)}}" id="profile-img-tag" width="200px" />
                                        </div>

                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger" id="ajaxResponse">

                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">

                                            <input class="btn btn-primary" type="submit" id="submit" value="Ndryshoje">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-offset-2 load"></div><br>
                                    <div class="col-12 col-md-offset-2  edit_alert " style="color:white;padding:10px;">
                                        <ul>


                                        </ul>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')


    <script type="text/javascript">



        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#profile-img").change(function(){
            readURL(this);
        });




        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


        @if($video->filename == 'nofile')
        video_id = $('.youtube').val() ;

        @else

         video_id = $('.video').val() ;
        document.getElementById("video1").src = '{{asset('videoligjerata')}}/'+video_id;


        @endif

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


    </script>

@endsection