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
                                    <a href="{{route('category.create')}}" class="btn  btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add New</a>
                                </div>

    <hr>

                        @if (\Session::has('success'))
                            <div class="alert alert-success">

                                    <p>{!! \Session::get('success') !!}</p>

                            </div>
                        @endif

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

                                    <tr>
                                    <td class="hidden-sm hidden-xs"> {{ $cat->id }} </td>
                                    <td> {{ $cat->name_sq }} </td>
                                        <td> {{ $cat->name_de }} </td>
                                    <td class="hidden-sm hidden-xs"> {{ $cat->created_at }} </td>
                                        <td class="hidden-sm hidden-xs"> {{ $cat->updated_at }} </td>
                                    <td style="text-align:center"><a href="{{route('category.edit',$cat->id)}}" class="col-12 col-md-12 btn-primary btn-block"> <i class="fa fa-edit"></i> </a>
                                        <form action="{{route('category.destroy',$cat->id)}}" id="form_delete" accept-charset="UTF-8" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="{{$cat->id}}">
                                            <button type="submit"  class="col-12 col-md-12 btn-danger btn-block delete"><i class="fa fa-trash"></i></button>
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