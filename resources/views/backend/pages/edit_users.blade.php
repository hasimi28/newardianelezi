@extends('backend.adm_master')


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
                <li><a href="#">Create Users</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form class="form-horizontal"  id="forma_edit" action="{{route('users.update',$user->id)}}" method="POST">
                    {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div class="well bs-component">


                                <input type='hidden' name='_method' value='PUT'>
                                <fieldset>
                                    <legend>Edit Users</legend>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputEmail">Name</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" name="name" id="name" type="text" value="{{$user->name}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputEmail">Email</label>
                                        <div class="col-lg-10">

                                            <input class="form-control" name="email" id="email" value="{{$user->email}}" type="text" placeholder="Email">

                                        </div>
                                    </div>


                                    <div class="clearfix"></div>

                                    <label class="animated-checkbox" style="margin-left:20%;">
                                        <input type="checkbox" id="check" name="check" value="no"><span class="label-text">Change Password</span>
                                    </label>
                                    <div class="clearfix"></div>

                                    <br>

                                    <div class="clearfix"></div>
                                    <div class="form-group" id="pass_hide" style="display:none">
                                        <label class="col-lg-2 control-label" for="inputPassword">Password</label>
                                        <div class="col-lg-10" >
                                            <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password">


                                        </div>
                                    </div>

                                    <div class="form-group" id="pass2_hide" style="display:none">
                                        <label class="col-lg-2 control-label" for="inputPassword">Password Confirm</label>
                                        <div class="col-lg-10" >
                                            <input class="form-control" name="password_confirmation" id="inputPassword" type="password" placeholder="Password">


                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-top:10px;">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button class="btn btn-default" type="reset">Cancel</button>
                                            <input class="btn btn-primary" type="submit" id="submit" value="Submit">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-offset-2 load"></div><br>
                                    <div class="col-12 col-md-offset-2  edit_alert " style="color:white;padding:10px;">
                                        <ul>


                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-offset-2  alert alert-success suk" style="color:white;padding:10px;display:none;">
sukses
                                    </div>
                                </fieldset>

                        </div>
                    </div>


                    <div class="col-7 col-md-7">

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Roles</h3>
                                {{ $user->roles->count() == 0 ? 'Per momentin nuk ka asnje rol me posht mund te zgjedhesh ndonje rol' :'' }}
                            </div>
                            <div class="panel-body">

                                <div class="col-12 ol-lg-12">

                                    <div class="bs-component">

                                        <ul class="list-group">


                                            @foreach($user->roles as $i)
                                                <li class="list-group-item" style="display:none;">
                                                    <i class="animated-checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="checked1" value="{{$i->id}}"  ><span class="label-text"></span>
                                                        </label>
                                                    </i>

                                                    {{$i->display_name}} <i class="m-sm-3">({{$i->description}})</i></li>
                                            @endforeach

                                            @foreach($roles as $p)

                                                <li class="list-group-item">
                                                    <i class="animated-checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="checked1" value="{{$p->id}}" name="roles[]" ><span class="label-text"></span>
                                                        </label>
                                                    </i>

                                                    {{$p->display_name}} <i class="m-sm-3">({{$p->description}})</i></li>

                                            @endforeach




                                        </ul>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')

    @include('backend.pages.js_files.edit_users_js')
    <script>



        var seen = {};
        $('.checked1').each(function() {
            var txt = $(this).val();
            if (seen[txt])
                $(this).prop('checked',true);
            else
                seen[txt] = true;
        });
    </script>
@endsection