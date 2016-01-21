<html>
	<head>
		<title>Document Classification</title>
		
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
                                
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.links {
				font-size: 24px;    
			}
                        a{
                            
                            text-decoration-line: none;
                            color: #333333;

                        }
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
                            <div class="title">Document Classification</div>
                                <div class="links"><a href="{{ route('auth.register') }}">Register</a> | <a href="{{ route('auth.login') }}">Login</a></div>
			</div>
		</div>
	</body>
</html>
