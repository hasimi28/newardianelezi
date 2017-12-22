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
    <div class="row">
        <div class="col-md-12">

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


                                    <th  class="hidden-sm hidden-xs">ID</th>
                                    <th>Name SQ</th>
                                    <th>Name DE</th>
                                    <th class="hidden-sm hidden-xs">Created</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($cat as $c)

                                    <tr>
                                        <td  class="hidden-sm hidden-xs"> {{  $c->id }} </td>
                                        <td> {{  $c->name_sq }} </td>
                                        <td> {{  $c->name_de }} </td>
                                        <td> {{  $c->created_at }} </td>
                                        <td style="text-align:center">
                                            <a href="{{route('gallerycat.edit', $c->id)}}" class="btn-primary btn-block" > Edit</a>
                                            <form action="{{route('gallerycat.destroy', $c->id)}}" id="form_delete" accept-charset="UTF-8" method="POST" style="margin-top:3px">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="{{ $c->id}}">
                                                <button type="submit"  class="col-12 col-md-12 btn-danger btn-block delete"> Delete</button>
                                            </form>

                                        </td>

                                    </tr>

                                @endforeach




                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-3">

                        @if (\Session::has('success'))
                            <div class="alert alert-success">

                                <p>{!! \Session::get('success') !!}</p>

                            </div>
                        @endif
                        <form class="bs-component" action="{{route('gallerycat.store')}}" method="POST">
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

    @include('include.datatable')

@endsection