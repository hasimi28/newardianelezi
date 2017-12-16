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

                                    <tr>
                                    <td class="hidden-sm hidden-xs"> {{ $qu->id }} </td>
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