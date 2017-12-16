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
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                <tr>


                                    <th  class="hidden-sm hidden-xs">ID</th>
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

                                    <tr>
                                        <td  class="hidden-sm hidden-xs"> {{ $vi->id }} </td>
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
                                                <button type="submit"  class="col-12 col-md-12 btn-danger btn-block delete"> Delete</button>
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

    @include('include.datatable')

@endsection