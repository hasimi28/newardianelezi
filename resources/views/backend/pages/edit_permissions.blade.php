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
                            @if (\Session::has('success'))
                                <div class="alert alert-success">

                                    <p>{!! \Session::get('success') !!}</p>

                                </div>
                            @endif
                            <form class="form-horizontal" id="forma" action="{{route('permissions.update',$permissions->id)}}" method="POST">
                                {{ csrf_field() }}
                                {{method_field('PUT')}}
                                <fieldset>
                                    <legend>Create Permissions</legend>


                                    <div class="basic">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputEmail">Display Name</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" name="display_name" id="name" type="text" value="{{$permissions->display_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputEmail">Slug</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" name="name" id="email" type="text" value="{{$permissions->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputPassword">Description</label>
                                        <div class="col-lg-10" >
                                            <textarea class="form-control" id="password"  name="description">{!! $permissions->description !!}</textarea>
                                        <br>

                                        </div>
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
                                            <input class="btn btn-primary" type="submit" id="submit" value="Save">
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

@include('backend.pages.js_files.insert_permission_js')

@endsection