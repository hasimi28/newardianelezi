@extends('backend.adm_master')

@section('head')

@endsection
    @section('content')
        <div class="page-title">

            <div>
                <h1><i class="fa fa-th-list"></i> All Event </h1>

            </div>
            <div>
                <ul class="breadcrumb side">
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="{{url('/backend/dashboard')}}"> BackEnd </a></li>
                    <li class="active"><a href="{{url('/backend/users')}}">Event</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

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

                        <table class="table table-hover table-bordered" id="sampleTable">

                            <thead>
                            <tr>


                                <th class="hidden-sm hidden-xs">ID</th>
                                <th>Titulli Shqip</th>
                                <th>Titulli Gjermanisht</th>
                                <th>Data-Koha e ligjerates</th>
                                <th>Adresa-Vendi</th>

                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>

                                @foreach($ev as $qu)

                                    <tr>
                                    <td class="hidden-sm hidden-xs"> {{ $qu->id }} </td>
                                    <td> <a href="{{route('event.edit',$qu->id)}}"> {{ $qu->ti_sq }} </a></td>
                                        <td> {{ $qu->ti_de }} </td>
                                        <td> {{ $qu->datetime }} </td>
                                        <td> {{ $qu->adress }} </td>

                                    <td style="text-align:center"><a href="{{route('event.edit',$qu->id)}}" class="col-12 col-md-12 btn-primary btn-block"> <i class="fa fa-eye"></i> </a>
                                        <form action="{{route('event.destroy',$qu->id)}}" id="form_delete" accept-charset="UTF-8" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="{{$qu->id}}">
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