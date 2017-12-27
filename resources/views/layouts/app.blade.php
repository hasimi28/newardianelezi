<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ config('app.name') }} - @yield('title')</title>

    @include('include/headfile')

    @yield('head')

</head>

<body style="overflow-x:hidden;">

    <div class="wraper">

@include('include/header')




        @yield('content')



@include('include/footer')

    </div>

@include('include/jsfiles')

@yield('js')
    <script type="text/javascript">


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
