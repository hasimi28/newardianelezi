@extends('backend.adm_master')


    @section('content')
        <div class="page-title">

            <div>
                <h1><i class="fa fa-th-list"></i> Perdoruesit </h1>
                <p>SuperAdmins/Admins/Authors/Editors/Contributors/Subscribers</p>
                <a href="{{route('users.create')}}" class="btn btn-primary">Add New Users</a>
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
                        @if (\Session::has('success'))
                            <div class="alert alert-success">

                                    <p>{!! \Session::get('success') !!}</p>

                            </div>
                        @endif
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>


                                <th class="hidden-sm hidden-xs">ID</th>
                                <th class="hidden-sm hidden-xs">Name</th>
                                <th>Email</th>
                                <th class="hidden-sm hidden-xs">Created</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>

                                @foreach($users as $user)

                                    <tr>
                                    <td class="hidden-sm hidden-xs"> {{ $user->id }} </td>
                                    <td class="hidden-sm hidden-xs"> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td class="hidden-sm hidden-xs"> {{ $user->created_at }} </td>
                                    <td style="text-align:center"><a href="{{route('users.edit',$user->id)}}" class="col-12 col-md-12 btn-primary btn-block "> <i class="fa fa-edit"></i> </a>
                                        <form action="{{route('users.destroy',$user->id)}}" id="form_delete" accept-charset="UTF-8" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            <p> <button type="submit"  class="col-12 col-md-12 btn-danger btn-block delete"><i class="fa fa-trash"></i></button></p>
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

    @include('include.datatable')

@endsection