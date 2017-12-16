@extends('layouts.app')

@section('content')

    <div class="kode_contact_wrap">

        <!--CONTAINER START-->
        <!--KODE CONTACT DES START-->
        <div class="kode_contact_des">
            <div class="container">
                <div class="row">
                    <div class="kode_contact_field">
                        <div class="section_hdg hdg_2 hdg_3">
                            <a href="#"><img src="images/hdg-img.png" alt=""></a>
                            <h3>Perdorues</h3>
                            <span><i class="fa icon-building"></i></span>
                        </div>
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="col-md-3"></div>
                            <div class="col-md-6">

                                <div class="kf_commet_field">
                                    <input placeholder="Email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                </div>

                                <div class="kf_commet_field">
                                    <input placeholder="Password" name="password" type="password" value="" data-default="Name*" size="30" required>

                                </div>

                                <div class="kf_commet_field mt-2">
                                @if ($errors->has('email'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                @if ($errors->has('password'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>

                            <div class="col-md-12">

                                <p class="form-submit"><input name="submit" type="submit" class="medium_btn background-bg-dark btn_hover hvr-wobble-bottom" value="Kyqu"></p>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--KODE CONTACT SERVICE START-->

                <!--KODE CONTACT SERVICE END-->
            </div>
            <!--CONTAINER END-->
        </div>
        <!--KODE CONTACT DES END-->
    </div>
    <!--KODE 404 WRAP END-->

@endsection
