@extends('backend.adm_master')
@section('title')
Tags

@endsection

    @section('content')
        <div class="page-title">

            <div>
                <h1><i class="fa fa-th-list"></i> Tag : {{$tags->NameTrans('name')}} <small>Shkrime  ({{$tags->posts()->count()}}) </small>  </h1>

            </div>
            <div>
                <ul class="breadcrumb side">
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="{{url('/backend/dashboard')}}"> BackEnd </a></li>
                    <li class="active"><a href="{{url('/backend/users')}}">Tags</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">

                                    <p>{!! \Session::get('success') !!}</p>

                            </div>
                        @endif
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>


                                <button type="button" class="btn btn-danger btn-sm deleteAll" id="deleteAll" onclick=" event.preventDefault(); deleteall();" style="float:left;">Delete All Selected </button>
                                <th>Shkrimi Title SQ</th>
                                <th>Shkrimi Title DE</th>
                                <th>Tags Title SQ</th>
                                <th>Tags Title DE</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>

                                @foreach($tags->posts as $post)

                                    <tr class="tr_with_{{$post->id}}">
                                        <td class="hidden-sm hidden-xs"><input type="checkbox" class="checkthis" value="{{$tags->id}}" /> ID - {{$post->id}} </td>
                                    <td class="hidden-sm hidden-xs"> {{ $post->id }} </td>
                                    <td> {{ $post->title_sq }} </td>
                                    <td> {{ $post->title_de }} </td>

                       <td> @foreach($post->tags as $tag)
                        <span class="label label-default" style="margin-left:3px;"> {{ $tag->name_sq }} </span> @endforeach</td>

                        <td> @foreach($post->tags as $tag)
                       <span class="label label-default"  style="margin-left:3px;"> {{ $tag->name_de }} </span> @endforeach</td>

                                    <td style="text-align:center"><a href="{{route('tags.edit',$tags->id)}}" class="col-12 col-md-12 btn-primary btn-block "> <i class="fa fa-edit"></i> </a>
                                        <form action="{{route('tags.destroy',$tags->id)}}" id="form_delete" accept-charset="UTF-8" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="{{$tags->id}}">
                                            <p> <button type="submit"    class="col-12 col-md-12 btn-danger btn-block delete"><i class="fa fa-trash"></i></button></p>
                                        </form>

                                       </td>

                                    </tr>

                                @endforeach




                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>



    @endsection

@section('js')
    <script>
        $("#checkall").click(function () {
            $('#sampleTable tbody input[type="checkbox"]').prop('checked', this.checked);
        });


        function deleteall(){


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


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    if ($('input[type=checkbox]').is(":checked")) {

                        $('#status_load').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');



                        var array = [];


                        $(':checkbox:checked').each(function (i) {
                            array[i] = $(this).val();
                        });

                        $.each(array, function (i, val) {


                            $.ajax({
                                url: '{{url('backend/del_all_tags')}}',
                                type: 'POST',
                                data: {val: val},
                                success: function (msg) {
                                    if (msg.status === 'success') {

                                        $.notify({
                                            title: "Sukses : ",
                                            message: " Postimet u fshi me sukses",
                                            icon: 'fa fa-check'

                                        },{
                                            type: "info"
                                        });

                                        setInterval(function () {

                                            $('.tr_with_'+val).hide();


                                            $('#status_load').html("");


                                        }, 1000);

                                        swal("Success!", "Postimet u fshin me sukses.", "success");
                                    }

                                },
                                error: function (data) {
                                    if (data.status === 422) {
                                        toastr.error('Cannot delete the category');
                                    }
                                }
                            });


                        });
                    }else{

                        alert('{{trans('app_words.no_selected')}} ');
                    }



                } else {
                    swal("Anuluar", "Fshirja u anulua :)", "error");
                }
            });


        }






    </script>
    @include('include.datatable')

@endsection