<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">



        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">OPTIONS</li>
            <!-- Optionally, you can add icons to the links -->
          <!-- <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>Home</span></a></li>-->
            <!--<li><a href="#"><i class='fa fa-link'></i> <span>Tasks</span></a></li>-->

            @can('see-admin-menu')
            <li class="active"><a href="{{ url('tasks') }}"><i class='fa fa-link'></i> <span>Tasks</span></a></li>


            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Train Files</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('trains') }}">Upload New Train File</a></li>
                    <li><a href="{{ url('ltrains') }}">Management Train Files</a></li>
                </ul>
            </li>
            <li> <a href="#"><i class='fa fa-link'></i> <span>Test Files / Analysis</span></a></li>
            @endcan
            @can('see-user-menu')
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Test Files</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Upload New Test File</a></li>
                    <li><a href="#">Management Test Files</a></li>
                </ul>
            </li>
            @endcan
        </ul><!-- /.sidebar
        -menu -->
    </section>
    <!-- /.sidebar -->
</aside>
