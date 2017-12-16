@extends('backend.adm_master')


@section('content')

    <div class="page-title">
        <div>
            <h1><i class="fa fa-edit"></i> Edit Video</h1>
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
                            {{ Form::model($video,['route' => ['videomanagerde.update',$video->id], 'method' => 'put','class'=>'form-horizontal','files'=>true]) }}
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
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="inputPassword">ID Youtube Video</label>
                                        <div class="col-lg-10" >
                                            <input class="form-control" id="password" type="text" name="youtube_id" value="{{$video->youtube_id}}">
                                        <br>

                                        </div>
                                    </div>

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


@endsection