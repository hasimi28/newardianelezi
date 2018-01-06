@extends('backend.adm_master')

@section('head')

@endsection
    @section('content')
        <div class="page-title">

            <div>
                <h1><i class="fa fa-th-list"></i> All Questions </h1>
                <p>SuperAdmins/Admins/Authors/Editors/Contributors/Subscribers</p>

            </div>
            <div>
                <ul class="breadcrumb side">
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="{{url('/backend/dashboard')}}"> BackEnd </a></li>
                    <li class="active"><a href="{{url('/backend/users')}}">PostCategory</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="status_load" style="text-align:center;color:teal"></div>
                <div class="card">
                    <div class="card-body">


                                <div class="form-group">
                                    <a href="{{route('questions.create')}}" class="btn  btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add New</a>
                                </div>

    <hr>

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

                                <th>Titulli I Pyetjes</th>
                                <th>Emri</th>
                                <th>Email</th>
                                <th>Statusi I Pyetjes</th>
                                <th class="hidden-sm hidden-xs">Koha</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>

                                @foreach($questions as $qu)

                                    <tr class="tr_with_{{$qu->id}}">
                                        <td><input type="checkbox" class=" hidden-sm hidden-xs checkthis" value="{{$qu->id}}" /> ID - {{$qu->id}} </td>

                                    <td> <a href="{{route('questions.show',$qu->id)}}"> {{ $qu->question_title }} </a></td>
                                        <td> {{ $qu->asker->name }} </td>
                                        <td> {{ $qu->asker->email }} </td>
                                        <td> @if($qu->status_public == '2') Eshte Publike @elseif($qu->status_public == '1') Kerkon Te Jet Publike @else Private @endif</td>
                                        <td class="hidden-sm hidden-xs"> {{ $qu->created_at->diffForHumans() }} </td>
                                    <td style="text-align:center"><a href="{{route('questions.show',$qu->id)}}" class="col-12 col-md-12 btn-primary btn-block"> <i class="fa fa-eye"></i> </a>
                                        <form action="{{route('questions.destroy',$qu->id)}}" id="form_delete" accept-charset="UTF-8" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="{{$qu->id}}">
                                            <button type="submit" onclick="event.preventDefault();  ondelete({{$qu->id}});" class="col-12 col-md-12 btn-danger btn-block delete"><i class="fa fa-trash"></i></button>
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
                                    url: '{{url('backend/del_all_questions')}}',
                                    type: 'POST',
                                    data: {val: val},
                                    success: function (msg) {
                                        if (msg.status === 'success') {

                                            $.notify({
                                                title: "Sukses : ",
                                                message: "Pyetjet u fshin me sukses",
                                                icon: 'fa fa-check'

                                            },{
                                                type: "info"
                                            });

                                            setInterval(function () {

                                                $('.tr_with_'+val).hide();


                                                $('#status_load').html("");


                                            }, 1000);

                                            swal("Success!", "Pyetjet u fshin me sukses.", "success");
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
                            @if($questions->count()) @foreach ($questions as $ta) url: "{{route('questions.destroy',$ta->id)}}", @endforeach @endif

                            type: 'DELETE',
                            data: {val: id},
                            success: function (msg) {
                                if (msg.status === 'success') {

                                    $.notify({
                                        title: "Sukses : ",
                                        message: "Pyetja u fshi me sukses",
                                        icon: 'fa fa-check'

                                    },{
                                        type: "info"
                                    });

                                    setInterval(function () {

                                        $('.tr_with_'+id).hide();


                                        $('#status_load').html("");


                                    }, 1000);

                                    swal("Success!", "Pyetja u fshin me sukses.", "success");
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