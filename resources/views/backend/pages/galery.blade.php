
    @extends('backend.adm_master')

    @section('head')
        <link rel="stylesheet" href="{{asset('css/themes/css/dropzone.min.css')}}" type="text/css">


    @endsection
    @section('content')
        <style>
            .gallery-title
            {
                font-size: 36px;

                text-align: center;
                font-weight: 500;
                margin-bottom: 70px;
            }
            .gallery-title:after {
                content: "";
                position: absolute;
                width: 7.5%;
                left: 46.5%;
                height: 45px;
                border-bottom: 1px solid #5e5e5e;
            }
            .filter-button
            {
                font-size: 15px;
                border: 1px solid teal;
                border-radius: 5px;
                text-align: center;
                color: white;
                margin-bottom: 30px;
                background-color: grey;

            }
            .filter-button:hover
            {
                font-size: 15px;
                border: 1px solid #42B32F;
                border-radius: 5px;
                text-align: center;

                background-color: #777

            }

            .btn-default:active .filter-button:active .filter-button:visited
            {
                background-color: #42B32F;
                color: teal;
            }
            .port-image
            {
                width: 100%;
            }
            img {
                cursor: zoom-in;
            }
            .gallery_product
            {
                margin-bottom: 30px;
            }

            .active{

                background-color: grey;
                color:grey;
            }
        </style>
        <div class="page-title">
            <div>
                <h1><i class="fa fa-edit"></i> Form Components</h1>
                <p>Bootstrap default form components</p>
            </div>
            <div>
                <ul class="breadcrumb">
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li>Forms</li>
                    <li><a href="#">All Galery</a></li>
                </ul>
            </div>
        </div>
        <section>
        <div class="container">
            <div class="row">

                @if (\Session::has('success'))
                    <div class="alert alert-success">

                        <p>{!! \Session::get('success') !!}</p>

                    </div>
                @endif
                <div align="center">
                    <button class="btn btn-primary filter-button btn-sm" data-filter="all">All</button>
                    @foreach($cat as $c)


                    <button class="btn btn-primary filter-button btn-sm" data-filter="{{$c->id}}">{{$c->NameTrans('name')}}</button>

                    @endforeach
                </div>
                <br/>


                @foreach($galery as $gal)
                <div class="gallery_product col-lg-2 col-md-4 col-sm-4 col-xs-6 filter {{$gal->catgallery->id}}"  id="tr_with_{{$gal->id}}" style="text-align:center;">
                    <img src="{{asset('gallery/'.$gal->image)}}" class="img-responsive">
                    <form action="{{route('gallery.destroy',$gal->id)}}" id="form_delete" accept-charset="UTF-8" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="{{$gal->id}}">
                        <button type="submit"  onclick="event.preventDefault();  ondelete({{$gal->id}});"  class="col-12 col-md-12 btn-danger btn-block"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        </section>



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
     <script>$(document).ready(function(){

             $(".filter-button").click(function(){
                 var value = $(this).attr('data-filter');
                 $(this).addClass("active");
                 if(value == "all")
                 {
                     //$('.filter').removeClass('hidden');
                     $('.filter').show('1000');
                 }
                 else
                 {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                     $(".filter").not('.'+value).hide('3000');
                     $('.filter').filter('.'+value).show('3000');

                 }
             });

             if ($(".filter-button").hasClass("active")) {
                 $(this).removeClass("active");
             }


         });

         $(function() {
             $('img').on('click', function() {
                 $('.enlargeImageModalSource').attr('src', $(this).attr('src'));
                 $('#enlargeImageModal').modal('show');
             });
         });




         function ondelete(id){

             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });


             swal({
                 title: "Jeni i sigurt?",
                 text: "Je i sigurt se deshiron te vazhdosh fshirjen!",
                 type: "warning",
                 showCancelButton: true,
                 confirmButtonText: "Po!",
                 cancelButtonText: "Jo,Anuloje!",
                 closeOnConfirm: false,
                 closeOnCancel: false
             }, function(isConfirm) {
                 if (isConfirm) {
                     $.ajax({
                         @if($galery->count()) @foreach ($galery as $k) url: "{{route('gallery.destroy',$k->id)}}", @endforeach @endif

                         type: 'DELETE',
                         data: {val: id},
                         success: function (msg) {
                             if (msg.status === 'success') {

                                 $.notify({
                                     title: "Sukses : ",
                                     message: "Foto u fshi me sukses",
                                     icon: 'fa fa-check'

                                 },{
                                     type: "info"
                                 });

                                 setInterval(function () {

                                     $('#tr_with_'+id).hide();


                                     $('#status_load').html("");


                                 }, 1000);

                                 swal("Success!", "Foto u fshi me sukses.", "success");
                             }

                         },
                         error: function (data) {
                             if (data.status === 422) {
                                 toastr.error('Cannot delete the category');
                             }
                         }
                     });


                 } else {
                     swal("Anuluar", "fshirja u anulua :)", "error");
                 }

             });


         }
</script>
    @endsection