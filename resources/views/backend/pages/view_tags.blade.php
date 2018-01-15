@extends('backend.adm_master')


@section('content')

    <div class="page-title">
        <div>
            <h1><i class="fa fa-edit"></i> Form Components</h1>
            <p>Bootstrap default form components</p>
        </div>
        <div>
            <ul class="breadcrumb">

                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Forms</li>
                <li><a href="#">Add Tag</a></li>
            </ul>
        </div>
    </div>

    <div class="form-group">
        <a href="{{route('tags.create')}}" class="btn  btn-primary icon-btn" type="submit" style="float:right;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add New</a>
        <p style="float:left;margin-right:10px;"> Select All <input type="checkbox" id="checkall"  /> </p>   <button type="button" class="btn btn-danger btn-sm deleteAll" id="deleteAll" onclick="deleteall();" style="float:left;">Delete All Selected </button>

    </div>



    <div class="row">
        <div class="col-md-12">
            <div id="status_load" style="text-align:center;color:teal"></div>

            <div class="card">
                <div class="row">
                    @if ($errors->any())
                        <div class="alert alert-danger">

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="col-lg-8">

                        <div class="well bs-component">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                <tr>

                                    <th>ID </th>


                                    <th>Name SQ</th>
                                    <th>Name DE</th>
                                    <th class="hidden-sm hidden-xs">Created</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($tags as $tag)

                                   <tr class="tr_with_{{$tag->id}}">
                                    <td><input type="checkbox" class="checkthis hidden-sm hidden-xs" value="{{$tag->id}}" />{{$tag->id}} </td>

                                        <td> {{ $tag->name_sq }} </td>
                                        <td> {{ $tag->name_de }} </td>
                                        <td> {{ $tag->created_at }} </td>
                                        <td style="text-align:center">
                                            <a href="{{route('tags.show',$tag->id)}}" class=" btn-info btn-block"> View </a>
                                            <a href="{{route('tags.edit',$tag->id)}}" class="btn-primary btn-block" > Edit</a>

                                            <form action="{{route('tags.destroy',$tag->id)}}" id="form_delete" accept-charset="UTF-8" method="POST" style="margin-top:3px">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="{{$tag->id}}">
                                                <button type="submit" onclick="event.preventDefault();  ondelete({{$tag->id}});"  class="col-12 col-md-12 btn-danger btn-block delete"> Delete</button>
                                            </form>

                                        </td>

                                    </tr>

                                @endforeach




                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-3">


                        <form class="bs-component" action="{{route('tags.store')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label" for="focusedInput">Name SQ</label>
                                <input class="form-control" name="name_sq" id="focusedInput" type="text" placeholder="Name SQ">
                            </div>


                            <div class="form-group">
                                <label class="control-label" for="focusedInput">Name DE</label>
                                <input class="form-control"  name="name_de" id="focusedInput" type="text" placeholder="Name DE">
                            </div>

                            <div class="form-group" style="float:right">
                                <div class="col-lg-12">
                                    <input class="btn btn-sm btn-primary" type="submit"  value="ADD NEW">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')


    @if (\Session::has('success'))

        <script>

            $.notify({
                title: "Sukses : ",
                message: "Tagi u shtua me sukses",
                icon: 'fa fa-check'

            },{
                type: "info"
            });
        </script>

    @endif

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
                                url: '{{url('backend/del_all_tags')}}',
                                type: 'POST',
                                data: {val: val},
                                success: function (msg) {
                                    if (msg.status === 'success') {

                                        $.notify({
                                            title: "Sukses : ",
                                            message: "Taget u fshin me sukses",
                                            icon: 'fa fa-check'

                                        },{
                                            type: "info"
                                        });

                                        setInterval(function () {

                                            $('.tr_with_'+val).hide();


                                            $('#status_load').html("");


                                        }, 1000);

                                        swal("Success!", "Taget u fshin me sukses.", "success");
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
                        @if($tags->count()) @foreach ($tags as $ta) url: "{{route('tags.destroy',$ta->id)}}", @endforeach @endif

                        type: 'DELETE',
                        data: {val: id},
                        success: function (msg) {
                            if (msg.status === 'success') {

                                $.notify({
                                    title: "Sukses : ",
                                    message: "Tagi u fshi me sukses",
                                    icon: 'fa fa-check'

                                },{
                                    type: "info"
                                });

                                setInterval(function () {

                                    $('.tr_with_'+id).hide();


                                    $('#status_load').html("");


                                }, 1000);

                                swal("Success!", "Tagi u fshi me sukses.", "success");
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