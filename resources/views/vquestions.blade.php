@extends('layouts.app')



@section('content')

    <div class="kode_contact_des">
        <div class="container">
            <div class="row">

                <div class="kode_service_faq">

                    {{--<h4 class="comment_title">Pyetjet e Parashtruara</h4>--}}
                    <a class="medium_btn theme_color_bg btn_hover2" style="float:right;" href="{{route('ask.index')}}">Parashtro Pyetje</a>
                    <div class="accordion">
                        @foreach ($questions as $qu)
                        <div class="accordion-section">

                            <h6><a class="accordion-section-title" href="#accordion-{{$qu->id}}">{{$qu->question_title}} </a></h6>
                            <div id="accordion-{{$qu->id}}" class="accordion-section-content" style="display: none;">

                                <p> {!! $qu->question !!}</p>

                                <hr>

                                <h6 style="color:#666666"> Pergjigja </h6> <br>
                                <p style="color:#666666"> {{$qu->answer->answer_title}} </p>
                                {!! $qu->answer->answer !!}
                               <b style="float:right;"> {{$qu->answer->created_at->diffForHumans()}}</b>
                            </div><!--end .accordion-section-content-->
                        </div><!--end .accordion-section-->
                        @endforeach


                    </div><!--end .accordion-->
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

                @if($questions->count())

                    {{$questions->links('vendor.pagination.bootstrap-4') }}

                @endif
                </div>
            </div>
            <!--KODE CONTACT SERVICE START-->


            <!--KODE CONTACT SERVICE END-->
        </div>
        <!--CONTAINER END-->
    </div>

@endsection