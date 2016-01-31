<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>D</b>CL</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Document</b>Classification </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">



                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">


                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">Welcome {{ Auth::user()->name }}</span>
                    </a>


                </li>

                <li>
                    <a href="{{ url('/auth/logout') }}"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>