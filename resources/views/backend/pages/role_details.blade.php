@extends('backend.adm_master')




@section('content')
    <div class="page-title">
        <div>
            <h1><i class="fa fa-archive"></i> {{$roles->display_name}} </h1>
            <p>{{$roles->description}}</p><br>
            <a href="{{route('roles.edit',$roles->id)}}" class="btn btn-primary btn-sm">Edit Roles</a>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Backend</li>
                <li><a href="#">Roles</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Permissions</h3>
            </div>
            <div class="panel-body">


                <div class="col-12 ol-lg-12">

                    <div class="bs-component">

                        <ul class="list-group">
                            @foreach($roles->permissions as $p)


                            <li class="list-group-item">  {{$p->display_name}} <i class="m-sm-3">({{$p->description}})</li>

                            @endforeach
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>

    </div>


@endsection