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
                            url: '{{url('backend/del_all_users')}}',
                            type: 'POST',
                            data: {val: val},
                            success: function (msg) {
                                if (msg.status === 'success') {

                                    $.notify({
                                        title: "Sukses : ",
                                        message: "Perdorueset u fshi me sukses",
                                        icon: 'fa fa-check'

                                    },{
                                        type: "info"
                                    });

                                    setInterval(function () {

                                        $('.tr_with_'+val).hide();


                                        $('#status_load').html("");


                                    }, 1000);

                                    swal("Success!", "Perdorueset u fshin me sukses.", "success");
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
                    @if($users->count()) @foreach ($users as $us) url: "{{route('users.destroy',$us->id)}}", @endforeach @endif

                    type: 'DELETE',
                    data: {val: id},
                    success: function (msg) {
                        if (msg.status === 'success') {

                            $.notify({
                                title: "Sukses : ",
                                message: " Perdoruesi u fshi me sukses",
                                icon: 'fa fa-check'

                            },{
                                type: "info"
                            });

                            setInterval(function () {

                                $('.tr_with_'+id).hide();


                                $('#status_load').html("");


                            }, 1000);

                            swal("Success!", "Perdoruesi u fshi me sukses.", "success");
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
