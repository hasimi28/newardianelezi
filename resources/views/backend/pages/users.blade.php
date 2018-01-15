@extends('backend.adm_master')


    @section('content')
        <div class="page-title">

            <div>
                <h1><i class="fa fa-th-list"></i> Perdoruesit </h1>


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
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <a href="{{route('users.create')}}" class="btn  btn-primary icon-btn" type="submit" style="float:right;"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add New</a>
                            <p style="float:left;margin-right:10px;"> Select All <input type="checkbox" id="checkall"  /> </p>   <button type="button" class="btn btn-danger btn-sm deleteAll" id="deleteAll" onclick="deleteall();" style="float:left;">Delete All Selected </button>

                        </div>
                        <br>   <br>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>


                                <th class="hidden-sm hidden-xs"> ID </th>
                                <th class="hidden-sm hidden-xs">Name</th>
                                <th>Email</th>
                                <th class="hidden-sm hidden-xs">Created</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>

                                @foreach($users as $user)


                                    <tr class="tr_with_{{$user->id}}">
                                        <td><input type="checkbox" class="checkthis hidden-sm hidden-xs" value="{{$user->id}}" />  {{$user->id}} </td>
                                    <td class="hidden-sm hidden-xs"> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td class="hidden-sm hidden-xs"> {{ $user->created_at }} </td>
                                    <td style="text-align:center"><a href="{{route('users.edit',$user->id)}}" class="col-12 col-md-12 btn-primary btn-block "> <i class="fa fa-edit"></i> </a>
                                        <form action="{{route('users.destroy',$user->id)}}" id="form_delete" accept-charset="UTF-8" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            <p> <button type="submit" onclick="event.preventDefault();  ondelete({{$user->id}});"  class="col-12 col-md-12 btn-danger btn-block delete"><i class="fa fa-trash"></i></button></p>
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
                message: "Perdoruesi u shtua me sukses",
                icon: 'fa fa-check'

            },{
                type: "info"
            });
        </script>
@endif


        @include('backend.pages.js_files.delete_users_js')
    @include('include.datatable')

@endsection