@extends('layouts.app')



@section('content')
    <div class="kode_contact_des">
        <div class="container">
            <div class="row">
                <div class="kode_contact_field">
                    <div class="section_hdg hdg_2 hdg_3">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">

                                <p>{!! \Session::get('success') !!}</p>

                            </div>
                        @endif
                        <a href="#"><img src="images/hdg-img.png" alt=""></a>
                        <h3>Contact Us</h3>
                        <span><i class="fa icon-building"></i></span>
                    </div>
                    <form method="post" id="commentform" class="comment-form" action="{{route('ask.store')}}">
                        {{csrf_field()}}
                        <div class="col-md-4">
                            <div class="kf_commet_field">
                                <input placeholder="Emri" name="name" type="text" value="" data-default="Name*" size="30" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="kf_commet_field">
                                <input placeholder="Email" name="email" type="text" value="" data-default="Name*" size="30" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="kode_payment_list">

                                <ul class="radio_points">

                                    <li>
                                        <div class="checkbox_radio">
                                            <input type="radio" name="status_public" value="0" id="radio1">
                                            <span></span>
                                            <label for="radio1">Pyetje Private</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox_radio">
                                            <input type="radio" name="status_public" value="1" id="radio2">
                                            <span></span>
                                            <label for="radio2">Pyetje Publike</label>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="kf_commet_field">
                                <input placeholder="Titulli Pyetjes" name="question_title" type="text" value="" data-default="Name*" size="30" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="kode_textarea">
                                <textarea placeholder="Pyetja" name="question"></textarea>
                            </div>
                            <p class="form-submit"><input name="submit" type="submit" class="medium_btn background-bg-dark btn_hover hvr-wobble-bottom" value="Dergo"></p>
                        </div>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger" id="ajaxResponse">

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <!--KODE CONTACT SERVICE START-->
            <div class="kode_contact_service">
                <ul>
                    <li>
                        <div class="kode_contact_text">
                            <h5><a href="#">ADDRESS</a></h5>
                            <a href="#"><i class="fa fa-map-marker"></i></a>
                            <p><span>8569 Johanwolfgang street</span>
                                Berlin Germany L, 688521
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="kode_contact_text">
                            <h5><a href="#">PHONE</a></h5>
                            <a href="#"><i class="fa fa-map-marker"></i></a>
                            <p><span>Landline : 37/5 77868 777 688</span>
                                Mobile : +87 66665 7785 7
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="kode_contact_text">
                            <h5><a href="#">EMAIL ADDRESS</a></h5>
                            <a href="#"><i class="fa fa-map-marker"></i></a>
                            <p><span>General : info@islamic.com</span>
                                Office : info@islamic.com
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
            <!--KODE CONTACT SERVICE END-->
        </div>
        <!--CONTAINER END-->
    </div>

@endsection