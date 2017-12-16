<!doctype html>
<html lang="en">
<head>

    @include('backend.pages.head')
    @yield('head')
  <title>  @yield('title') </title>
</head>

<body class="sidebar-mini fixed">

@include('backend\pages.header_nav')

<div class="wrapper">
    <div class="content-wrapper">

@yield('content')

    </div>
</div>

@include('backend.pages.script_js')
@yield('js')



@yield('footer')

<script>


    $('.lang').click(function(e){
        e.preventDefault();

        var lang = $(this).attr('name');

        $.ajax({
            url:'{{url('/language')}}',
            type : 'GET',
            data : {lang:lang},
            datartype : 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success : function(data)  {


            }  ,

            error:function(data){


            },

            beforesend:function(data){


            },

            complete:function(data){


                window.location.reload(true);
            }


        });
    });
</script>
</body>
</html>