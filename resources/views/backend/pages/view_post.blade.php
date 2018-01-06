@extends('backend.adm_master')


@section('content')
    <div id="fb-root"></div>

    <div class="page-title">

        <div>
            <h1><i class="fa fa-th-list"></i> Posts </h1>
            <p>SuperAdmins/Admins/Authors/Editors/Contributors/Subscribers</p>
            <a href="{{route('post.create')}}" class="btn btn-primary">Add New Post</a>

        </div>

        <div>
            <ul class="breadcrumb side">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li><a href="{{url('/backend/dashboard')}}"> BackEnd </a></li>
                <li class="active"><a href="{{url('/backend/users')}}">Users</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="status_load" style="text-align:center;color:teal"></div>
            <div class="card">

                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">

                            <p>{!! \Session::get('success') !!}</p>

                        </div>
                    @endif
                        <button type="button" class="btn btn-danger btn-sm deleteAll" id="deleteAll" onclick="deleteall();" style="float:left;">Delete All Selected </button>
                    <table class="table table-hover table-bordered" id="sampleTable">

                        <thead>
                        <tr>

                            <th class="hidden-sm hidden-xs"><input type="checkbox" id="checkall" /> All </th>
                           <th>Title</th>
                            <th class="hidden-sm hidden-xs">Slug</th>
                            <th class="hidden-sm hidden-xs">Desc</th>
                            <th class="hidden-sm hidden-xs">Created</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($posts as $po)

                            <tr class="tr_with_{{$po->id}}">
                                <td class="hidden-sm hidden-xs"><input type="checkbox" class="checkthis" value="{{$po->id}}" /> ID - {{$po->id}} </td>

                                <td> {{ $po->TextTrans('title') }} </td>

                                <td class="hidden-sm hidden-xs"> {{ $po->TextTrans('slug') }} </td>
                                <td class="hidden-sm hidden-xs">  {!! str_limit($po->TextTrans('desc'), 150) !!} </td>

                                <td class="hidden-sm hidden-xs"> {{ $po->created_at }} </td>
                                <td style="text-align:center"> <a href="{{route('post.edit',$po->id)}}" class="col-12 col-md-12 btn-primary btn-block"> <i class="fa fa-edit"></i> </a>
                                    <form action="{{route('post.destroy',$po->id)}}" id="form_delete" accept-charset="UTF-8" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="{{$po->id}}">
                                       <button type="submit"  onclick="event.preventDefault();  ondelete({{$po->id}});" class="col-12 col-md-12 btn-danger btn-block"><i class="fa fa-trash"></i></button>
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

        if ($('input[type=checkbox]').is(":checked")) {

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



                    $('#status_load').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');



                    var array = [];


                    $(':checkbox:checked').each(function (i) {
                        array[i] = $(this).val();
                    });

                    $.each(array, function (i, val) {


                        $.ajax({
                            url: '{{url('backend/del_all_post')}}',
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




            } else {
                swal("Anuluar", "Fshirja u anulua :)", "error");
            }
        });

        }else{

            alert('{{trans('app_words.no_selected')}} ');
        }

    }






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
                    @if($posts->count()) url: "{{route('post.destroy',$po->id)}}", @endif

                    type: 'DELETE',
                    data: {val: id},
                    success: function (msg) {
                        if (msg.status === 'success') {

                            $.notify({
                                title: "Sukses : ",
                                message: " Postimi u fshi me sukses",
                                icon: 'fa fa-check'

                            },{
                                type: "info"
                            });

                            setInterval(function () {

                                $('.tr_with_'+id).hide();


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


            } else {
                swal("Anuluar", "Fshirja u anulua :)", "error");
            }

        });


    }
</script>
    @include('include.datatable')

@endsection