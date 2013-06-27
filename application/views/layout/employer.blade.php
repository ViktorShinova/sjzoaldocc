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
		{{ HTML::style('/css/main.css') }}
		{{ HTML::style('/css/font-awesome.min.css') }}
		@yield('custom_styles')
		<script src="/js/vendor/modernizr-2.6.2.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

	</head>
	<body id="@yield('page-id')" class="employer">

		@include ('layout.nav-bar')



		<div id="content" class="container clearfix">
			<div class="row">
				
				
				<div class="navbar span12" id="secondary-nav">
					<div class="navbar-inner">
						
						<ul class="nav">
							<li class="page-employer-adverts"><a href="/employer/post/list">Job Adverts</a>
								
								<ul class="drop-shadow-black">
									<li><a href="/employer/post/create">Create Job Advert</a></li>
									<li><a href="/employer/post/list">Active Job Adverts</a></li>
									<li><a href="/employer/post/archived/">Archived Job Adverts</a></li>
									
								</ul>
							
							</li>
							<li class='page-employer-template'><a href="/employer/template/list">Templating</a>
								
								<ul class="drop-shadow-black">
									<li><a href="/employer/template/create">Create Template</a></li>
									<li><a href="/employer/template/list">Browse Templates</a></li>
								</ul>
							
							</li>
			<!--			<li class='page-employer-email'><i class="icon-envelope icon-white"></i> <a href="/employer/email/">Email templates</a></li>-->
							<li class='page-employer-invoice'><a href="/employer/invoices/">Transactions</a></li>
							<li class='page-employer-search'><a href="/employer/candidate/search">Hunt for Candidates</a></li>
							<li class='page-employer-profile'><a href="/employer/profile/">My Account</a></li>
						</ul>
					</div>
				</div>

				<div class="clearfix"></div>
				<div class="span12">
					@yield('content')
				</div>
			</div>
		</div>
		<!-- /#content -->
		@include('layout.footer')

		@include ('layout.emp-scripts')
	</body>


</html>