<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">



        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">OPTIONS</li>

            @can('see-admin-menu')
            <li class="active"><a href="{{ url('tasks') }}"><i class='fa fa-tasks'></i> <span>Tasks</span></a></li>
            <li><a href="{{ url('trains') }}"><i class='fa fa-file-text'></i> <span>Train Files</span></a></li>
            <li> <a href="#"><i class='fa fa-bar-chart'></i> <span>Test Files / Analysis</span></a></li>
            @endcan

            @can('see-user-menu')
            <li class="active"> <a href="{{ url('tests') }}"><i class='fa fa-file-text'></i> <span>Test Files</span></a></li>
            @endcan

        </ul><!-- /.sidebar
        -menu -->
    </section>
    <!-- /.sidebar -->
</aside>
