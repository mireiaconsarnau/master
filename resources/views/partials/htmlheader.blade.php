<head>
    <meta charset="UTF-8">
    <title> Document Classification - @yield('htmlheader_title', 'Your title here') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset('/css/skins/skin-blue.css') }}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset('/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" href="{{ asset('/jvectormap/jquery-jvectormap.css') }}" type="text/css" media="screen"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>




    <![endif]-->
    <script>

        function confirmDelete()
        {
            var x = confirm("Are you sure you want to delete the task and associated test files?");
            if (x)
                return true;
            else
                return false;
        }

        function confirmDeleteTrain()
        {
            var x = confirm("Are you sure you want to delete the train file?");
            if (x)
                return true;
            else
                return false;
        }
        function confirmDeleteUser()
        {
            var x = confirm("Are you sure you want to delete this user and all his test files and all his train files?");
            if (x)
                return true;
            else
                return false;
        }





    </script>
    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('/js/jquery-jvectormap-2.0.3.min.js') }}"></script>
    <script src="{{ asset('/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js') }}"></script>

    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>




</head>
