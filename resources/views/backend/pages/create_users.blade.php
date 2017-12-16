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
                <div class="row">
                    <div class="col-lg-6 col-md-offset-2">
                        <div class="well bs-component">
                            <form class="form-horizontal" id="forma" action="{{url('/backend/users')}}" method="POST">
                                {{ csrf_field() }}

                                <fieldset>
                                    <legend>Create Users</legend>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputEmail">Name</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputEmail">Email</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" name="email" id="email" type="text" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputPassword">Password</label>
                                        <div class="col-lg-10" >
                                            <input class="form-control" id="password" type="password" name="password" placeholder="Password">
                                        <br>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputPassword">Password</label>
                                        <div class="col-lg-10" >
                                            <input class="form-control" name="password_confirmation" id="confirm_pass" type="password" placeholder="Password">
                                            <br>

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
                                            <button class="btn btn-default" type="reset">Cancel</button>
                                            <input class="btn btn-primary" type="submit" id="submit" value="Submit">
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

@include('backend.pages.js_files.insert_users_js')

@endsection