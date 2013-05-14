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
    	@yield('custom_styles')
		<script src="/js/vendor/modernizr-2.6.2.min.js"></script>
		<script type="text/javascript" src="//use.typekit.net/ypy5trg.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		
	</head>

	<body id="@yield('page-id')">

		<header id="brand">
			<a href="/" title="Back to home"><img src="/img/logo-top.png" /><h1>Careershire | Advertiser Dashboard</h1></a>
		</header>

		<nav>
			<h1 class="container-header">Menu</h1>

			<ul>
				<li class="page-employer-post"><i class="icon-pencil icon-white"></i> <a href="/employer/post/create">Create an Advertisement</a></li>
				<li class="page-employer-index"><i class="icon-file icon-white"></i> <a href="/employer/post/list">Active Job Advertisement</a></li>
				<li class='page-employer-archived'><i class="icon-time icon-white"></i> <a href="/employer/post/archived/">Archived Post</a></li>
				<li class='page-employer-template'><i class="icon-th-large icon-white"></i> <a href="/employer/template/list">Custom Templates</a></li>
				<li class='page-employer-profile'><i class="icon-briefcase icon-white"></i> <a href="/employer/profile/">My Account</a></li>
<!--			<li class='page-employer-email'><i class="icon-envelope icon-white"></i> <a href="/employer/email/">Email templates</a></li>-->
				<li class='page-employer-invoice'><i class="icon-barcode icon-white"></i> <a href="/employer/invoices/">Payment Transactions</a></li>
				<li class='page-employer-search'><i class="icon-user icon-white"></i> <a href="/employer/candidate/search">Search Applicants</a></li>
				<li><i class="icon-off icon-white"></i> <a href="/logout/">Log Out</a></li>
			</ul>
		</nav>
		<!-- /nav -->
		<div id="board" class="wide">
		@yield('content')
		</div>

		@include ('layout.emp-scripts')

	</body>
	
</html>