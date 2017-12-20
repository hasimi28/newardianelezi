<header class="main-header hidden-print"><a class="logo" href="index.html">ArdianElezi</a>
    <nav class="navbar navbar-static-top" >
        <!-- Sidebar toggle button--><a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
        <!-- Navbar Right Menu-->
        <div class="navbar-custom-menu" >
            <ul class="top-nav">
                <!--Notification Menu-->
                <li class="dropdown notification-menu"><a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell-o fa-lg"></i></a>
                    <ul class="dropdown-menu">
                        <li class="not-head">You have 4 new notifications.</li>
                        <li><a class="media" href="javascript:;"><span class="media-left media-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                                <div class="media-body"><span class="block">Lisa sent you a mail</span><span class="text-muted block">2min ago</span></div></a></li>
                        <li><a class="media" href="javascript:;"><span class="media-left media-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                                <div class="media-body"><span class="block">Server Not Working</span><span class="text-muted block">2min ago</span></div></a></li>
                        <li><a class="media" href="javascript:;"><span class="media-left media-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                                <div class="media-body"><span class="block">Transaction xyz complete</span><span class="text-muted block">2min ago</span></div></a></li>
                        <li class="not-footer"><a href="#">See all notifications.</a></li>
                    </ul>
                </li>
                <!-- User Menu-->

                <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i></a>
                    <ul class="dropdown-menu settings-menu">

                        <li><a href="#" class="lang" name="de"><img src="{{ asset('css/themes/images/de.png') }}" alt=""> DE</a></li>
                        <li><a href="#" class="lang" name="sq"><img src="{{ asset('css/themes/images/al.png') }}" alt=""> SQ</a></li>
                        <li> <form action="{{URL('logout')}}" method="POST">
                            {{ csrf_field() }}
                         <button type="submit"  class="btn btn-md btn-primary" >Logout</button></form></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Side-Nav-->
<aside class="main-sidebar hidden-print" >
    <section class="sidebar" >
        <div class="user-panel">
            <div class="pull-left image"><img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image"></div>
            <div class="pull-left info">
                <p>Welcome</p>
                <p class="designation"> {{Auth::getUser()->name}} </p>
            </div>
        </div>
        <!-- Sidebar Menu-->
        <ul class="sidebar-menu" >

            <li class="active"><a href="{{route('backend.dashboard')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
            <li class="treeview"><a href="#"><i class="fa fa-edit"></i><span>Posts/Categories</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('post.index')}}"><i class="fa fa-circle-o"></i> Posts</a></li>
                    <li><a href="{{route('post.create')}}" ><i class="fa fa-circle-o"></i> Add Post</a></li>
                    <li><a href="{{route('category.index')}}" ><i class="fa fa-circle-o"></i> Category </a></li>
                    <li><a href="{{route('category.create')}}" ><i class="fa fa-circle-o"></i> Add Category </a></li>

                </ul>
            </li>
            <li class="treeview"><a href="#"><i class="fa fa-edit"></i><span>Tags</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('tags.index')}}"><i class="fa fa-circle-o"></i> View Tags</a></li>


                </ul>
            </li>
            <li class="treeview"><a href="#"><i class="fa fa-users"></i><span>Users</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i> All Users </a></li>
                    <li><a href="{{route('users.create')}}"><i class="fa fa-circle-o"></i> Add Users </a></li>
                    <li><a href="{{route('permissions.index')}}" ><i class="fa fa-circle-o"></i> Permissions</a></li>
                    <li><a href="{{route('permissions.create')}}"><i class="fa fa-circle-o"></i> Create Permissions</a></li>
                    <li><a href="{{route('roles.index')}}"><i class="fa fa-circle-o"></i> Role </a></li>

                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-question"></i><span>Questions</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('questions.index')}}"><i class="fa fa-circle-o"></i> All Questions </a></li>
                    <li><a href="{{route('questions.create')}}"><i class="fa fa-circle-o"></i> Add Question </a></li>


                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-users"></i><span>Video</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('videomanager.index')}}"><i class="fa fa-circle-o"></i> Video Shqip </a></li>
                    <li><a href="{{route('videomanager.create')}}"><i class="fa fa-circle-o"></i> Add Video Shqip </a></li>
                    <li><a href="{{route('videomanagerde.index')}}"><i class="fa fa-circle-o"></i> Video Gjermanisht </a></li>
                    <li><a href="{{route('videomanagerde.create')}}"><i class="fa fa-circle-o"></i> Add Video Gjermanisht </a></li>

                </ul>
            </li>
            <li class="treeview"><a href="#"><i class="fa fa-users"></i><span>Video Category</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('categorymanager.index')}}"><i class="fa fa-circle-o"></i> Kategorit Shqip </a></li>
                    <li><a href="{{route('categorymanager.create')}}"><i class="fa fa-circle-o"></i> Add Kategori Shqip </a></li>
                    <li><a href="{{route('categorymanagerde.index')}}"><i class="fa fa-circle-o"></i> Kategorit Gjermanisht </a></li>
                    <li><a href="{{route('categorymanagerde.create')}}"><i class="fa fa-circle-o"></i> Add Kategori Gjermanisht </a></li>

                </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-users"></i><span>Galery</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('gallery.index')}}"><i class="fa fa-circle-o"></i> Galeria </a></li>
                    <li><a href="{{route('gallery.create')}}"><i class="fa fa-circle-o"></i> Add Galery </a></li>


                </ul>
            </li>
        </ul>

    </section>
</aside>

