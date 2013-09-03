<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->

	<head>

		<title></title>

		<meta charset="utf-8" />

		<meta name="description" content="" />

		<meta name="robots" content="index,follow" />
		<meta name="revisit-after" content="7 days" />
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="favicon.ico" />
		<!--[if lt IE 9]>
		{{ HTML::style('/css/font-awesome-ie7.min.css') }}
		<![endif]-->	
		
		{{ HTML::style('/css/main.css') }}
		{{ HTML::style('/css/home.css') }}
		{{ HTML::style('/css/font-awesome.min.css') }}
		<script src="/js/vendor/modernizr-2.6.2.min.js"></script>
	</head>

	<body id="home">

		@include('layout.header')
		<div id="content" class="container">
			@yield('content')
		</div>
        <!-- /#wrapper -->
		@include('layout.footer')
        @include ('layout.footer-scripts')
    </body>

</html>