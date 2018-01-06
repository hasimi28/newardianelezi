@extends('backend.adm_master')


@section('content')

    <div class="page-title">
        <div>
            <h1><i class="fa fa-edit"></i> Video Gjermanisht </h1>
            <p>Bootstrap default form components</p>

        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Forms</li>
                <li><a href="#">Video</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="status_load" style="text-align:center;color:teal"></div>
            <div class="card">
                <div class="row">
                    <div class="form-group">
                        <a href="{{route('videomanagerde.create')}}" class="btn  btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Shto Video</a>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-lg-12">

                        <div class="well bs-component">
                            <button type="button" class="btn btn-danger btn-sm deleteAll" id="deleteAll" onclick="deleteall();" style="float:left;">Delete All Selected </button>
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                <tr>


                                    <th class="hidden-sm hidden-xs"><input type="checkbox" id="checkall" /> All </th>
                                    <th>Title</th>
                                    <th class="hidden-sm hidden-xs">Youtube ID</th>
                                    <th class="hidden-sm hidden-xs">Kategoria</th>
                                    <th class="hidden-sm hidden-xs">File Name</th>
                                    <th class="hidden-sm hidden-xs">Created</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($video as $vi)

                                    <tr class="tr_with_{{$vi->id}}">
                                        <td><input type="checkbox" class="hidden-sm hidden-xs checkthis" value="{{$vi->id}}" /> ID - {{$vi->id}} </td>
                                        <td> {{ $vi->title }} </td>
                                        <td class="hidden-sm hidden-xs"> {{ $vi->youtube_id }} </td>
                                        <td class="hidden-sm hidden-xs"> {{ $vi->video_category_de->name }} </td>
                                        <td class="hidden-sm hidden-xs"> {{ $vi->filename }} </td>
                                        <td class="hidden-sm hidden-xs"> {{ $vi->created_at }} </td>
                                        <td style="text-align:center">

                                            <a href="{{route('videomanagerde.edit',$vi->id)}}" class="btn-primary btn-block" > Edit</a>

                                            <form action="{{route('videomanagerde.destroy',$vi->id)}}" id="form_delete" accept-charset="UTF-8" method="POST" style="margin-top:3px">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="{{$vi->id}}">
                                                <button type="submit" onclick="event.preventDefault();  ondelete({{$vi->id}});"  class="col-12 col-md-12 btn-danger btn-block delete"> Delete</button>
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
                                url: '{{url('backend/del_all_videode')}}',
                                type: 'POST',
                                data: {val: val},
                                success: function (msg) {
                                    if (msg.status === 'success') {

                                        $.notify({
                                            title: "Sukses : ",
                                            message: "Videot u fshin me sukses",
                                            icon: 'fa fa-check'

                                        },{
                                            type: "info"
                                        });

                                        setInterval(function () {

                                            $('.tr_with_'+val).hide();


                                            $('#status_load').html("");


                                        }, 1000);

                                        swal("Success!", "Videot u fshin me sukses.", "success");
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
                        @if($video->count()) @foreach ($video as $v) url: "{{route('videomanagerde.destroy',$v->id)}}", @endforeach @endif

                        type: 'DELETE',
                        data: {val: id},
                        success: function (msg) {
                            if (msg.status === 'success') {

                                $.notify({
                                    title: "Sukses : ",
                                    message: "Video u fshi me sukses",
                                    icon: 'fa fa-check'

                                },{
                                    type: "info"
                                });

                                setInterval(function () {

                                    $('.tr_with_'+id).hide();


                                    $('#status_load').html("");


                                }, 1000);

                                swal("Success!", "Video u fshin me sukses.", "success");
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