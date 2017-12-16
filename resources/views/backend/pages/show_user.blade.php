@extends('backend.adm_master')


@section('content')

    <div class="row user">
        <div class="col-md-12">
            <div class="profile">
                <div class="info"><img class="user-img" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/128.jpg">
                    <h4> {{$user->name}} </h4>
                    <p>{{$user->email}}</p>
                </div>
                <div class="cover-image"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-0">
                <ul class="nav nav-tabs nav-stacked user-tabs">
                    <li class="active"><a href="#user-timeline" data-toggle="tab">Timeline</a></li>
                    <li><a href="#user-settings" data-toggle="tab">Settings</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="user-timeline">
                    <div class="timeline">

                        <div class="post">
                            <div class="post-media"><a href="#"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg"></a>
                                <div class="content">
                                    <h5><a href="#">John Doe</a></h5>
                                    <p class="text-muted"><small>2 January at 9:30</small></p>
                                </div>
                            </div>
                            <div class="post-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,	quis tion ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                            <ul class="post-utility">
                                <li class="likes"><a href="#"><i class="fa fa-fw fa-lg fa-thumbs-o-up"></i>Like</a></li>
                                <li class="shares"><a href="#"><i class="fa fa-fw fa-lg fa-share"></i>Share</a></li>
                                <li class="comments"><i class="fa fa-fw fa-lg fa-comment-o"></i> 5 Comments</li>
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" style="display:inline;">
                    <div class="card user-settings">
                        <h4 class="line-head">Edit</h4>
                        <form action="{{route('users.update',$user->id)}}" method="POST">
                            {{ csrf_field() }}

                                    <input type='hidden' name='_method' value='PUT'>

                            <div class="row mb-20">
                                <div class="col-md-4">
                                    <label> Name</label>
                                    <input class="form-control" type="text" name="name" value="{{$user->name}}">
                                </div>
                                <div class="col-md-4">
                                    <label>Email</label>
                                    <input class="form-control" type="text" name="email" value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="animated-checkbox">
                                <label>
                                    <input type="checkbox" id="check" ><span class="label-text">Change Password</span>
                                </label>
                            </div>
                            <br>
                            <div class="row" style="display:none" id="pass_hide">
                                <div class="col-md-8 mb-20">
                                    <label>New Password</label>
                                    <input class="form-control" type="text" name="password">
                                </div>
                                <div class="clearfix"></div>

                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop

@section('js')

    <script>


       $('#check').click(function(){

           if($(this).prop('checked')){

                $('#pass_hide').fadeIn();
           }else{

               $('#pass_hide').hide();
           }
       });

    </script>

@endsection

