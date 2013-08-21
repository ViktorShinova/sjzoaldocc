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
		<script src="/js/vendor/modernizr-2.6.2.min.js"></script>
		<style>
			#content { margin-top: 0;}
		</style>
	</head>
	<body> 

		<div class='container' id='content'>
			<div class='row'>
				@if( $success )
				<h3>Thank you. Your email has been sent.</h3>
				<a class='btn btn-warning' href="javascript:window.close();">Close this window and return to the website</a>
				@else
				<h3>There was an error sending this email. Please try again later.</h3>
				<a class='btn btn-warning' href="javascript:window.close();">Close this window and return to the website</a>
				@endif
				
			</div>
		</div>

		@include ('layout.footer-scripts')

	</body>
</html>