@extends('backend.adm_master')

@section('head')

@endsection
    @section('content')
        <div class="page-title">

            <div>
                <h1><i class="fa fa-th-list"></i> All Category </h1>
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

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <a href="{{route('category.create')}}" class="btn  btn-primary icon-btn" type="submit" style="float:right;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add New</a>
                            <p style="float:left;margin-right:10px;"> Select All <input type="checkbox" id="checkall"  /> </p>   <button type="button" class="btn btn-danger btn-sm deleteAll" id="deleteAll" onclick="deleteall();" style="float:left;">Delete All Selected </button>

                        </div>
                        <br>


    <hr>



                        <table class="table table-hover table-bordered" id="sampleTable">

                            <thead>
                            <tr>


                                <th class="hidden-sm hidden-xs">ID</th>
                                <th>Category Sq</th>
                                <th>Category De</th>
                                <th class="hidden-sm hidden-xs">Created</th>
                                <th class="hidden-sm hidden-xs">Updated</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>

                                @foreach($postcategory as $cat)

                                    <tr  class="tr_with_{{$cat->id}}">
                                    <td class="hidden-sm hidden-xs"><input type="checkbox" class="checkthis" value="{{$cat->id}}" />  {{ $cat->id }} </td>
                                    <td> {{ $cat->name_sq }} </td>
                                        <td> {{ $cat->name_de }} </td>
                                    <td class="hidden-sm hidden-xs"> {{ $cat->created_at }} </td>
                                        <td class="hidden-sm hidden-xs"> {{ $cat->updated_at }} </td>
                                    <td style="text-align:center"><a href="{{route('category.edit',$cat->id)}}" class="col-12 col-md-12 btn-primary btn-block"> <i class="fa fa-edit"></i> </a>
                                        <form action="{{route('category.destroy',$cat->id)}}" id="form_delete" accept-charset="UTF-8" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="{{$cat->id}}">
                                            <button type="submit"  onclick="event.preventDefault();  ondelete({{$cat->id}});"  class="col-12 col-md-12 btn-danger btn-block delete"><i class="fa fa-trash"></i></button>
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

        @if (\Session::has('success'))

            <script>

                $.notify({
                    title: "Sukses : ",
                    message: "Kategoria u shtua me sukses",
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
                                  url: '{{url('backend/del_cat_post')}}',
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
                          @if($postcategory->count()) url: "{{route('category.destroy',$cat->id)}}",  @endif

                          type: 'DELETE',
                          data: {val: id},
                          success: function (msg) {
                              if (msg.status === 'success') {

                                  $.notify({
                                      title: "Sukses : ",
                                      message: "Kategoria u fshi me sukses",
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
                      swal("Anuluar", "Fshirja u anulua :)", "error");
                  }

              });


          }


      </script>

    @include('include.datatable')

    @endsection