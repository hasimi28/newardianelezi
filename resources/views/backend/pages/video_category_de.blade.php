@extends('backend.adm_master')


@section('content')

    <div class="page-title">
        <div>
            <h1><i class="fa fa-edit"></i>Video Kategorit Gjermanisht</h1>
            <p>Bootstrap default form components</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li>Forms</li>
                <li><a href="">Category Gjermanisht</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="status_load" style="text-align:center;color:teal"></div>
            <div class="card">
                <div class="row">
                    <div class="form-group">
                        <a href="{{route('categorymanagerde.create')}}" class="btn  btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Shto Kategori</a>
                    </div>
                    @if (\Session::has('success'))
                        <div class="alert alert-success">

                            <p>{!! \Session::get('success') !!}</p>

                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-md-12">

                        <div class="well bs-component">
                            <button type="button" class="btn btn-danger btn-sm deleteAll" id="deleteAll" onclick="deleteall();" style="float:left;">Delete All Selected </button>
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                <tr>


                                    <th class="hidden-sm hidden-xs"><input type="checkbox" id="checkall" /> All </th>
                                    <th>Name</th>
                                    <th>Video</th>
                                    <th class="hidden-sm hidden-xs">Created</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($catde as $category)

                                    <tr class="tr_with_{{$category->id}}">
                                        <td><input type="checkbox" class="hidden-sm hidden-xs checkthis" value="{{$category->id}}" /> ID - {{$category->id}} </td>
                                        <td> {{ $category->name }} </td>
                                        <td>@if(!empty($category->video_de))  {{ $category->video_de->count() }} @else 0 @endif </td>
                                        <td> {{ $category->created_at }} </td>
                                        <td style="text-align:center">

                                            <a href="{{route('categorymanagerde.edit',$category->id)}}" class="btn-primary btn-block" > Edit</a>

                                            <form action="{{route('categorymanagerde.destroy',$category->id)}}" id="form_delete" accept-charset="UTF-8" method="POST" style="margin-top:3px">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="{{$category->id}}">
                                                <button type="submit" onclick="event.preventDefault();  ondelete({{$category->id}});"  class="col-12 col-md-12 btn-danger btn-block delete"> Delete</button>
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
                                url: '{{url('backend/del_all_videokatde')}}',
                                type: 'POST',
                                data: {val: val},
                                success: function (msg) {
                                    if (msg.status === 'success') {

                                        $.notify({
                                            title: "Sukses : ",
                                            message: "Kategorite u fshin me sukses",
                                            icon: 'fa fa-check'

                                        },{
                                            type: "info"
                                        });

                                        setInterval(function () {

                                            $('.tr_with_'+val).hide();


                                            $('#status_load').html("");


                                        }, 1000);

                                        swal("Success!", "Kategorite u fshin me sukses.", "success");
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
                        @if($catde->count()) @foreach ($catde as $k) url: "{{route('categorymanagerde.destroy',$k->id)}}", @endforeach @endif

                        type: 'DELETE',
                        data: {val: id},
                        success: function (msg) {
                            if (msg.status === 'success') {

                                $.notify({
                                    title: "Sukses : ",
                                    message: "Kategoria fshi me sukses",
                                    icon: 'fa fa-check'

                                },{
                                    type: "info"
                                });

                                setInterval(function () {

                                    $('.tr_with_'+id).hide();


                                    $('#status_load').html("");


                                }, 1000);

                                swal("Success!", "Kategoria u fshi me sukses.", "success");
                            }

                        },
                        error: function (data) {
                            if (data.status === 422) {
                                toastr.error('Cannot delete the category');
                            }
                        }
                    });


                } else {
                    swal("Anuluar", "Kategoria u anulua :)", "error");
                }

            });


        }

    </script>
    @include('include.datatable')

@endsection