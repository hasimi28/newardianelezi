@extends('layouts.app')
@section('head')


@section('title') Keshilla @endsection

@endsection
@section('content')
    <style>

        @media (max-width: 480px) {

            .new_post{

                width:100%;
            }

        }

        @media (min-width: 760px) {

            .new_post{

                width:30%;
            }

        }

        .zoom {
            -webkit-transition: all 0.35s ease-in-out;
            -moz-transition: all 0.35s ease-in-out;
            transition: all 0.35s ease-in-out;
            cursor: -webkit-zoom-in;
            cursor: -moz-zoom-in;
            cursor: zoom-in;
        }


    </style>
    <div class="kode_sab_banner_wrap them_overlay">
        <!--CONTAINER START-->
        <div class="container">
            <div class="sab_banner_text">
                <h2>Galeria</h2>
                <ul class="breadcrumbs">
                    <li><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
                    <li><strong>Galeria</strong></li>
                </ul>
            </div>
        </div>
        <!--CONTAINER END-->
    </div>

    <div class="kode_blog_madium_wrap wrap_2 padding">
        <!--CONTAINER START-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">

                        <div class="kode_portfolio_detail">
                            <ul class="simplefilter">
                                <li><a class="active" data-filter="all" href="javascript:void(0)">Show All</a></li>
                                @foreach($cat as $c)
                                    <li><a data-filter="{{$c->id}}" href="javascript:void(0)">{{$c->NameTrans('name')}}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="filtr-container">
                        @foreach($gallery as $g)

                            <div class="col-md-4 filtr-item thumbnail zoom" data-category="{{$g->catgallery->id}}">
                                <div class="kode_portfolio_des">
                                    <figure class="them_overlay">
                                        <img src="{{asset('gallery/'.$g->image)}}" class=" img-responsive img">
                                    </figure>

                                </div>
                            </div>

                    @endforeach

                        </div>
                        <!--KODE PAGINATION LIST END-->

                    </div>
                </div>

                <!--KODE PAGINATION LIST START-->

            <!--KODE PAGINATION LIST END-->
            </div>
        </div>
        <!--CONTAINER END-->
    </div>
    <div class="modal fade" id="enlargeImageModal" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <img src="" class="enlargeImageModalSource" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>

    $(function() {
        $('.filtr-item').on('click', function() {
            var img = $('.img',this).attr('src');
            $('.enlargeImageModalSource').attr('src', img);
            $('#enlargeImageModal').modal('show');
        });
    });
</script>

@endsection