<!DOCTYPE html>

<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->

	<head>
	
		<title>Careershire | Advertiser</title>

		<meta charset="iso-8859-1" />
		
		<meta name="description" content="" />

		<meta name="robots" content="index,follow" />
		<meta name="revisit-after" content="7 days" />
		
		<link rel="shortcut icon" href="/favicon.ico" />
		
		<!--[if lt IE 9]>
		<script src="/js/html5.js"></script>
		<![endif]-->
		{{ HTML::style('/css/bootstrap.css') }}
    	@yield('custom_styles')
		
	</head>

	<body>

		@yield('content')

	</body>
	
</html>