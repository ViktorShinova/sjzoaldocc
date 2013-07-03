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
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
		<!--[if lt IE 9]>
		{{ HTML::style('/css/font-awesome-ie7.min.css') }}
		<![endif]-->

		{{ HTML::style('/css/main.css') }}
		{{ HTML::style('/css/font-awesome.min.css') }}
		{{ HTML::style('/js/vendor/markitup/skins/markitup/style.css') }}
		{{ HTML::style('/js/vendor/markitup/sets/default/style.css') }}
		
		@yield('custom_styles')

		<script src="/js/vendor/modernizr-2.6.2.min.js"></script>
	</head>

	<body class="employer">

		@include ('layout.nav-bar')

		<div id="content" class="container">
			<div class="row">
			<div class="span2">
				<ul>
					<li><a href='/admin/page/list'>Pages</a></li>
					<li><a href='/admin/price/list'>Price</a></li>
				</ul>
			</div>
			@yield('content')
			</div>
		</div>
		<!-- /#content -->
		
		@include('layout.footer')

		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
		<script src="/js/vendor/ckeditor/ckeditor.js"></script>
		<script src="/js/plugins.js"></script>
		@yield('scripts')
		<script src="/js/admin.js"></script>
		<script>
		@yield('page-scripts')
		</script>
	</body>

</html>