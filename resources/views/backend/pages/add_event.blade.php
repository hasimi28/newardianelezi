@extends('backend.adm_master')

@section('head')

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('datetime/bootstrap-datetimepicker.css')}}" type="text/css">

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

    <script>tinymce.init({
            selector: 'textarea',  // change this value according to your HTML
            toolbar: 'fontselect,fontsizeselect',
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
                    <div class="col-lg-8 col-md-offset-2">

                        <div class="well bs-component">
                            <form class="form-horizontal" id="demo-form" action="{{route('event.store')}}" method="POST" data-parsley-validate enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <fieldset>
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


                                    <div class="form-group">

                                        <label class="col-lg-2 control-label" for="name">Title SQ</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" name="title_sq" id="title_sq" type="text" placeholder="Title Shqip" required=""
                                                   data-parsley-required-message="@lang('app_lang.parsley_required')">
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <label class="col-lg-2 control-label" for="name">Title DE</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" name="title_de" id="title_de" type="text" placeholder="Title Deutch"  required=""
                                                   data-parsley-required-message="@lang('app_lang.parsley_required')">
                                        </div>
                                    </div>



                                    <div class="form-group">

                                        <label class="col-lg-2 control-label" for="name">Text SQ</label>
                                        <div class="col-lg-10">
                                            <textarea class="form-control" id="textArea" name="text_sq" rows="3"
                                                      data-parsley-required-message="@lang('app_lang.parsley_required')"></textarea><span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <label class="col-lg-2 control-label" for="name">Text DE</label>
                                        <div class="col-lg-10">
                                            <textarea class="form-control" id="textArea" name="text_de" rows="3"  
                                                      data-parsley-required-message="@lang('app_lang.parsley_required')"></textarea><span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <label class="col-lg-2 control-label" for="name">Lokacioni</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" name="adress" id="title_de" type="text" placeholder="Lokacioni"  required=""
                                                   data-parsley-required-message="@lang('app_lang.parsley_required')">
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <label class="col-lg-2 control-label" for="name">Images</label>
                                        <div class="col-lg-10">
                                            <input type="file" name="image" id="profile-img" class="btn btn-primary btn-file"> <img src="" id="profile-img-tag" width="200px" />
                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label class="col-lg-2 control-label" for="name">Date</label>
                                        <div class="col-lg-10">
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' name="datetime" class="form-control" />
                                                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                                            </div>
                                        </div>

                                    </div>


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

    <script src="{{asset('js/parsley.min.js')}}" type="text/javascript"></script>


    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });

        $('.select2-multi').select2();


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