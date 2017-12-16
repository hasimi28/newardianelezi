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
                <li><a href="#">Edit Tags</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="col-lg-6 col-md-offset-2">
                        <div class="well bs-component">
                            <form class="form-horizontal" id="forma" action="{{route('tags.update',$tags->id)}}" method="POST">
                                {{ csrf_field() }}
                                <input type='hidden' name='_method' value='PUT'>
                                <fieldset>
                                    <legend>Edit Tags</legend>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputEmail">Name SQ</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" name="name_sq" id="name" type="text" value="{{$tags->name_sq}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputEmail">Name DE</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" name="name_de" id="email" type="text" value="{{$tags->name_de}}">
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

                                            <input class="btn btn-primary" type="submit" id="submit" value="Save Changes">
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



@endsection