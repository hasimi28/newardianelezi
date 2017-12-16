@extends('backend.adm_master')




@section('content')
    <div class="page-title">
        <div>
            <h1><i class="fa fa-archive"></i> Roles </h1>
            <p>  All  Roles </p>

            <a href="{{route('roles.create')}}" class="btn btn-primary">Add New Roles</a>
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
    @foreach($roles as $role)

        <div class="col-12 col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{$role->display_name}}</h3>
            </div>
            <div class="panel-body">  Name : {{$role->display_name}}<br>
                <br> <a href="{{route('roles.edit',$role->id)}}" class="btn btn-primary btn-sm">Edit</a>
                <a href="{{route('roles.show',$role->id)}}" class="btn btn-primary btn-sm">Details</a>  </div>
        </div>
    </div>
    @endforeach
    </div>


@endsection