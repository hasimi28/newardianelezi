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
@endsection

@section('content')
<div class="page-title">
    <div>
        <h1><i class="fa fa-edit"></i> Ndrysho Pergjigjen </h1>

    </div>
    <div>
        <ul class="breadcrumb">
            <li><i class="fa fa-home fa-lg"></i></li>
            <li>backend</li>
            <li><a href="#">Answer Edit</a></li>

        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="well bs-component">
                        <form class="form-horizontal" action="{{route('answer.update',$answer->id)}}" method="POST">
                            {{csrf_field()}}
                            <input type='hidden' name='_method' value='PUT'>
                            <fieldset>
                                <legend>Legend</legend>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="inputEmail">Titulli</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="inputEmail" name="answer_title" type="text" value="{{$answer->answer_title}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="textArea">Pergjigja</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" id="textArea" name="answer" rows="3">{!! $answer->answer !!}</textarea><span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="textArea" >Privatesia</label>
                                    <div class="col-lg-10">
                                        <div class="radio">
                                            <label>
                                                <input id="optionsRadios1" type="radio" name="status_public" value="2" @if($answer->questions->status_public == '2') checked @endif >Publike
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input id="optionsRadios2" type="radio" name="status_public" value="0"  @if($answer->questions->status_public == '0') checked @endif>Private
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button class="btn btn-default" type="reset">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
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