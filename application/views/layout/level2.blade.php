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
		
		<link rel="shortcut icon" href="favicon.ico" />
		{{ HTML::style('/css/bootstrap.css') }}
		{{ HTML::style('/css/bootstrap-responsive.css') }}
		{{ HTML::style('/css/jquery.taghandler.css') }}
		<!--[if lt IE 9]>
		{{ HTML::style('/css/font-awesome-ie7.min.css') }}
		<![endif]-->
		{{ HTML::style('/css/font-awesome.min.css') }}
		{{ HTML::style('/css/main.css') }}
		@yield('custom_styles')
		{{ Asset::scripts() }}
		<!--[if lt IE 9]>
		<script src="/js/html5.js"></script>
		<![endif]-->					
	</head>

	<body>
		
		@include ('layout.nav-bar')
		
		<div id="content" class="container">
		@yield('content')
		</div>
		<!-- /#content -->
		@include('layout.footer')

		@include ('layout.footer-scripts')
	</body>

</html>