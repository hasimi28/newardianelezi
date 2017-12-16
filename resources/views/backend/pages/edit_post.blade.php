 @extends('backend.adm_master')

@section('head')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({
            selector: 'textarea',  // change this value according to your HTML
            toolbar: 'fontselect,fontsizeselect',
            plugins:'link code',
            theme_advanced_fonts : "Andale Mono=andale mono,times;"+
            "Arial=arial,helvetica,sans-serif;"+
            "Arial Black=arial black,avant garde;"+
            "Book Antiqua=book antiqua,palatino;"+
            "Comic Sans MS=comic sans ms,sans-serif;"+
            "Courier New=courier new,courier;"+
            "Georgia=georgia,palatino;"+
            "Helvetica=helvetica;"+
            "Impact=impact,chicago;"+
            "Symbol=symbol;"+
            "Tahoma=tahoma,arial,helvetica,sans-serif;"+
            "Terminal=terminal,monaco;"+
            "Times New Roman=times new roman,times;"+
            "Trebuchet MS=trebuchet ms,geneva;"+
            "Verdana=verdana,geneva;"+
            "Webdings=webdings;"+
            "Wingdings=wingdings,zapf dingbats",
            fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
        });</script>

    {!! Html::script('css/select2.min.css') !!}
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
                <li><a href="#">Create Post</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 col-md-offset-1">

                        <div class="well bs-component">
                            <legend>Create New Post</legend>

                            @if ($errors->any())
                                <div class="alert alert-danger" id="ajaxResponse">

                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {{ Form::model($post,['route' => ['post.update',$post->id], 'method' => 'put','class'=>'form-horizontal','files'=>true]) }}
                            {{ csrf_field() }}
                            <div class="form-group">
                            {{ Form::label('category', 'Category', ['class' => 'col-lg-2 control-label','for'=>'select']) }}
                            <div class="col-lg-10">
                            {{ Form::select('category_id', $categories,null, ['class' => 'form-control','id'=>'select'])  }}
                            </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('tag', 'Tag', ['class' => 'col-lg-2 control-label','for'=>'select2']) }}
                                <div class="col-lg-10">
                                    {{ Form::select('tags[]', $tag,null, ['class' => 'form-control  select2-multi','id'=>'select2','multiple'=>'multiple'])  }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('title_sq', 'Title SQ', ['class' => 'col-lg-2 control-label','for'=>'title_sq']) }}
                                <div class="col-lg-10">
                                    {{ Form::text('title_sq', null, ['class' => 'form-control','id'=>'title_sq'])  }}
                                </div>
                            </div>



                            <div class="form-group">
                                {{ Form::label('title_de', 'Title DE', ['class' => 'col-lg-2 control-label','for'=>'title_de']) }}
                                <div class="col-lg-10">
                                    {{ Form::text('title_de', null, ['class' => 'form-control','id'=>'title_de'])  }}
                                </div>
                            </div>


                            <div class="form-group">
                                {{ Form::label('slug_sq', 'Slug SQ', ['class' => 'col-lg-2 control-label','for'=>'slug_sq']) }}
                                <div class="col-lg-10">
                                    {{ Form::text('slug_sq', null, ['class' => 'form-control','id'=>'slug_sq'])  }}
                                </div>
                            </div>



                            <div class="form-group">
                                {{ Form::label('slug_de', 'Slug DE', ['class' => 'col-lg-2 control-label','for'=>'slug_de']) }}
                                <div class="col-lg-10">
                                    {{ Form::text('slug_de', null, ['class' => 'form-control','id'=>'slug_de'])  }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('desc_sq', 'Desc SQ', ['class' => 'col-lg-2 control-label','for'=>'desc_sq']) }}
                                <div class="col-lg-10">
                                    {{ Form::textarea('desc_sq', null, ['class' => 'form-control','id'=>'desc_sq'])  }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('desc_de', 'Desc DE', ['class' => 'col-lg-2 control-label','for'=>'desc_de']) }}
                                <div class="col-lg-10">
                                    {{ Form::textarea('desc_de', null, ['class' => 'form-control','id'=>'desc_de'])  }}
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-lg-2 control-label" for="name">Images</label>
                                <div class="col-lg-10">
                                    <input type="file" name="image" id="profile-img" class="btn btn-primary btn-file"> <img src="{{asset('postimages/'.$post->image)}}" id="profile-img-tag" width="200px" />
                                </div>

                            </div>



                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button class="btn btn-default" type="reset">Cancel</button>
                                            <input class="btn btn-primary" type="submit" id="submit" value="Submit">
                                        </div>
                                    </div>
                            {{ Form::close() }}

                        </div>

                    </div>
                    <hr style="border:1px solid white">
                    <div class="col-12 col-md-5 alert alert-success" style="margin-top:15px;text-align:center">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">

                                <b>{!! \Session::get('success') !!}</b>
                                <p>View Post <a href="#"><b>View Post</b></a></p>
                            </div>
                        @endif




                        <b>Regjistruar : </b> {{date('M  j  Y - h:ia',strtotime($post->created_at))}} <br>
                        <b>Ndryshuar : </b>  {{date('M j Y - h:ia',strtotime($post->updated_at))}}


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')


    {!! Html::script('js/select2.min.js') !!}

    {!! Html::script('js/select2.min.js') !!}

        <script type="text/javascript">

                $('.select2-multi').select2();


        $('.select2-multi').select2();
        $('.select2-multi').select2().val({!!json_encode($post->tags()->allRelatedIds()) !!}).trigger('change');


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
    </script>
@endsection