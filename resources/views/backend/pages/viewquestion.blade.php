
@extends('backend.adm_master')


@section('content')
    <div class="page-title">
        <div>
            <h1><i class="fa fa-edit"></i> Pyetja </h1>

        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>backend</li>
                <li><a href="#">Pyetja</a></li>

            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="well bs-component"  style="word-wrap: break-word">

                                <fieldset>
                                    <legend>{{$question->question_title}}




                                                   <div class="btn-group" style="float:right;margin-right:40px;">
                                              <a class="btn btn-primary" href="#" style="margin-right:15px;"><i class="fa fa-lg fa-plus"></i></a>
                                              <a class="btn btn-info" href="{{route('questions.edit',$question->id)}}"><i class="fa fa-lg fa-edit"></i></a>
                                            <form action="{{route('questions.destroy',$question->id)}}" id="form_delete" accept-charset="UTF-8" method="POST" class="col-md-1" style="float:right;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="{{$question->id}}">
                                                <button type="submit" class="btn btn-warning" href="#" style="margin-right:-70px;"><i class="fa fa-lg fa-trash"></i></button>

                                            </form>
                                                   </div>
                                    </legend>
                                    <b>Emri : {{$question->asker->name}} </b><br>
                                    <b>Email :{{$question->asker->email}}</b><br>
                                    <b>Privatesia e pyetjes : @if($question->status_public == '1')
                                    Deshiron qe pyetja dhe pergjigja te behen publike @elseif ($question->status_public == '2') Kjo Pyetje Eshte Publike @else Pergjigja duhet te jet private @endif </b><br><br>
                                    <blockquote><b>Pyetja:</b> {!!  $question->question !!}</blockquote>

                                    <blockquote><b>Pergjigja:</b>  @if(isset($question->answer->answer_title)){{$question->answer->answer_title}} <a href="{{route('answer.edit',$question->answer->id)}}" class="btn btn-primary btn-sm" style="float:right">Ndryshoje Pergjigjen</a><br> {!! $question->answer->answer !!} @endif </blockquote>

                                   @if(!isset($question->answer))
                                    <form class="form-horizontal" action="{{route('answer.store')}}" method="POST">
                                        {{csrf_field()}}

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
                                        <label class="col-lg-2 control-label" for="inputEmail">Titulli Pergjigjes</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="inputEmail" type="text" value=" @if(isset($question->answer)){{$question->answer->answer_title}} @endif " name="answer_title">
                                        </div>
                                    </div>
                                    <input class="form-control" id="inputEmail" type="hidden" name="questions_id" value="{{$question->id}}">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="textArea">Pergjigja</label>
                                        <div class="col-lg-10">
                                            <textarea class="form-control" id="textArea" rows="3" name="answer"> @if(isset($question->answer)){!! $question->answer->answer !!} @endif </textarea><span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                                        </div>
                                    </div>

                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Privatesia e Pergjigjes</label>
                                            <div class="col-lg-10">
                                                <div class="radio">
                                                    <label>
                                                        <input id="optionsRadios1" type="radio" name="status_public" value="2" >Publike
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input id="optionsRadios2" type="radio" name="status_public" value="0">Private
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
                           @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection