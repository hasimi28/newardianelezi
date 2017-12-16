@extends('backend.adm_master')




@section('content')
    <div class="page-title">
        <div>
            <h1><i class="fa fa-archive"></i> Create Roles </h1>




        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Backend</li>
                <li><a href="#">Create Roles</a></li>
            </ul>
        </div>
    </div>
    <div class="row" style="background:white;">
        <form action="{{route('roles.store')}}" method="POST">
            {{csrf_field()}}

        <div class="col-12 col-md-12" style="background-color: white;padding:30px;">
        <div class="form-group">
            <label class="col-lg-2 control-label" for="inputEmail">Display Name</label>
            <div class="col-lg-10">
                <input class="form-control" name="display_name" id="display_name" type="text" value="{{old('display_name')}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" for="inputEmail">Slug</label>
            <div class="col-lg-10">
                <input class="form-control" name="name" id="email" type="text" value="{{old('name')}}" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" for="inputPassword">Description</label>
            <div class="col-lg-10" >
                <input type="text" class="form-control" id="desc"  name="description" value="{{old('description')}}">
                <br>

            </div>
        </div>
        </div>
        <div class="col-12 col-md-12">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Permissions</h3>

                </div>
                <div class="panel-body">

                    <div class="col-12 ol-lg-12">

                        <div class="bs-component">

                            <ul class="list-group">


                                @foreach($permissions as $p)

                                    <li class="list-group-item">
                                        <i class="animated-checkbox">
                                            <label>
                                      <input type="checkbox"  class="checked1" value="{{$p->id}}" name="permissions[]" ><span class="label-text"></span>
                                            </label>
                                        </i>

                                        {{$p->display_name}} <i class="m-sm-3">({{$p->description}})</i></li>

                                @endforeach




                            </ul>
                        </div>
                    </div>

                <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>

        </form>
    </div>



@endsection
@section('js')

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
