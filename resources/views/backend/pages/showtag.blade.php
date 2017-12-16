@extends('backend.adm_master')
@section('title')

    Tags
@endsection

    @section('content')
        <div class="page-title">

            <div>
                <h1><i class="fa fa-th-list"></i> Tag : {{$tags->NameTrans('name')}} <small>Shkrime  ({{$tags->posts()->count()}}) </small>  </h1>

            </div>
            <div>
                <ul class="breadcrumb side">
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="{{url('/backend/dashboard')}}"> BackEnd </a></li>
                    <li class="active"><a href="{{url('/backend/users')}}">Tags</a></li>
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
                                <th>Shkrimi Title SQ</th>
                                <th>Shkrimi Title DE</th>
                                <th>Tags Title SQ</th>
                                <th>Tags Title DE</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>

                                @foreach($tags->posts as $post)

                                    <tr>
                                    <td class="hidden-sm hidden-xs"> {{ $post->id }} </td>
                                    <td> {{ $post->title_sq }} </td>
                                    <td> {{ $post->title_de }} </td>

                       <td> @foreach($post->tags as $tag)
                        <span class="label label-default" style="margin-left:3px;"> {{ $tag->name_sq }} </span> @endforeach</td>

                        <td> @foreach($post->tags as $tag)
                       <span class="label label-default"  style="margin-left:3px;"> {{ $tag->name_de }} </span> @endforeach</td>

                                    <td style="text-align:center"><a href="{{route('tags.edit',$tags->id)}}" class="col-12 col-md-12 btn-primary btn-block "> <i class="fa fa-edit"></i> </a>
                                        <form action="{{route('tags.destroy',$tags->id)}}" id="form_delete" accept-charset="UTF-8" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="{{$tags->id}}">
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