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


                            <th>ID</th>
                            <th>Title</th>
                            <th class="hidden-sm hidden-xs">Slug</th>
                            <th class="hidden-sm hidden-xs">Desc</th>
                            <th class="hidden-sm hidden-xs">Created</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($posts as $po)

                            <tr>
                                <td> {{ $po->id }} </td>
                                <td> {{ $po->TextTrans('title') }} </td>

                                <td class="hidden-sm hidden-xs"> {{ $po->TextTrans('slug') }} </td>
                                <td class="hidden-sm hidden-xs">  {!! str_limit($po->TextTrans('desc'), 150) !!} </td>

                                <td class="hidden-sm hidden-xs"> {{ $po->created_at }} </td>
                                <td style="text-align:center"> <a href="{{route('post.edit',$po->id)}}" class="col-12 col-md-12 btn-primary btn-block"> <i class="fa fa-edit"></i> </a>
                                    <form action="{{route('post.destroy',$po->id)}}" id="form_delete" accept-charset="UTF-8" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="{{$po->id}}">
                                       <button type="submit"  class="col-12 col-md-12 btn-danger btn-block"><i class="fa fa-trash"></i></button>
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