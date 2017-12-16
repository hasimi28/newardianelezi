@extends('layouts.app')

@section('content')
    {{--<div class="row">--}}
    {{--<div class="col-12 col-md-offset2">--}}
    {{--<iframe src="http://www.quranflash.com/affiliate?en" frameborder="0" style="width: 100%; height: 700px;"></iframe>--}}
    {{--</div>--}}
    {{--</div>--}}
@endsection

@section('js')

    <script src="http://www.quranflash.com/embed.js" type="text/javascript"></script>
    <script type="text/javascript"> quranflash("container"); </script>
@endsection