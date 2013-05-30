<!DOCTYPE html>

<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->

	<head>
	
		<title>Careershire | Advertiser</title>

		<meta charset="utf-8" />
		
		<meta name="description" content="" />

		<meta name="robots" content="index,follow" />
		<meta name="revisit-after" content="7 days" />
		<link rel="shortcut icon" href="/favicon.ico" />
		
		{{ HTML::style('/css/employer.css') }}
		{{ HTML::style('/css/main.css') }}
		{{ HTML::style('/css/font-awesome.min.css') }}
    	@yield('custom_styles')
		<script src="/js/vendor/modernizr-2.6.2.min.js"></script>
		<script type="text/javascript" src="//use.typekit.net/ypy5trg.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		
	</head>
	<body id="@yield('page-id')">
		
		@include ('layout.nav-bar')
		
		<div id="content" class="container">
		@yield('content')
		</div>
		<!-- /#content -->
		@include('layout.footer')

		@include ('layout.emp-scripts')
	</body>
	
	
</html>