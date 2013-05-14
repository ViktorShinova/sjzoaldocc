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
		
		<!--[if lt IE 9]>
		{{ HTML::style('/css/font-awesome-ie7.min.css') }}
		<![endif]-->	
		{{ HTML::style('/css/font-awesome.min.css') }}
		{{ HTML::style('/css/main.css') }}
		<script src="/js/vendor/modernizr-2.6.2.min.js"></script>
		<script type="text/javascript" src="//use.typekit.net/ypy5trg.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
					
	</head>

	<body id="search-page">

		@include ('layout.nav-bar')
		<div class="featurette">
			<div class="container" id="top-search-filter">
				<div class="row">

					<div id="search-wrapper" class="span12 white-bg drop-shadow-black" data-spy="affix" data-offset-top="440">
						<h2 class="container-header">Refine this search</h2>
						<form class="row form-horizontal" method="get" action="/job/search">
							<div class="span6">

								<div class="control-group">
									<label class="control-label" for="keywords">Keywords</label>
									<div class="controls">
										{{ Form::text( 'keywords', $keywords, array( 'class'=> 'span2', 'placeholder' => 'Keywords', 'id' => 'keywords', 'class' => 'input-xlarge' ) ) }}
									</div>
								</div>
								<div class="control-group">

									<label class="control-label">Classification</label>
									<div class="controls">

										{{ Form::select('job-category', $categories, $selected_category , array('class' => 'input-xlarge', 'id' =>'job-category')); }}

									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Sub Classification</label>
									<div class="controls">

										{{ Form::select('job-sub-category', array("" => "Choose a sub category"), $selected_sub_category, array('class' => 'input-xlarge', 'id' =>'job-sub-category')); }}

									</div>
								</div>
								<div class="control-group"> 
									<label class="control-label">Salary Range <br/>(Annual Rate)</label>
									<div class="controls">

										<div class="input-prepend">
											<span class="add-on">$</span>
											{{ Form::select('min-salary', $min_salary , $selected_min_salary, array('class' => 'span1', 'id'=>'min-salary')); }}

										</div>
										<div class="input-prepend">
											<span class="add-on">$</span>
											{{ Form::select('max-salary', $max_salary , $selected_max_salary, array('class' => 'span1', 'id'=>'max-salary')); }}
										</div>

									</div>
								</div>
							</div>
							<div class="span6">
								<div class="control-group">
									<label class="control-label">Location</label>
									<div class="controls">
										{{ Form::select('job-location', $locations,  $selected_location, array('class' => 'input-xlarge', 'id'=>'job-location')); }}
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Sub Location</label>
									<div class="controls">
										{{ Form::select('job-sub-location', array("" => "Choose a sub location"), $selected_sub_location, array('class' => 'input-xlarge', 'id'=>'job-sub-location')); }}
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Work Type</label>
									<div class="controls">
										{{ Form::select('work-type[]', $work_types, $selected_work_types, array('class' => 'input-xlarge', 'multiple' => 'multiple')); }}
									</div>

								</div>
							</div>
							<button type="submit" id="search"class="btn btn-primary">Search</button>
						</form>
						<span id="pull-down" class="drop-shadow-black">Search Filter</span>
					</div>
				</div>
			</div>

		</div>
		<div id="content" class="container">
			<form class="row"  method="get" action="/job/search">

				<div class="span9 pull-left">
					@yield('content')
				</div>
				<aside class="span3 hidden-phone hidden-tablet">
					<div id="side-feature"  data-spy="affix" data-offset-top="575" data-offset-bottom="403">
						<ul id="feature-listing">
							<li>
								<a href="#">How to write a resume.</a>
							</li>
							<li>
								<a href="#">How to write a cover letter.</a>
							</li>
							<li>
								<a href="#">What are employers looking for?</a>
							</li>
							<li>
								<a href="#">Preparing for an interview</a>
							</li>
							<li>
								<a href="/applicant/shortlists">View all shortlist</a>
							</li>
						</ul>
					</div>
				</aside>

				<aside class="span3 hidden-desktop">
					<div id="side-feature-mobile">
						<ul id="feature-listing-mobile">
							<li>
								<a href="#">How to write a resume.</a>
							</li>
							<li>
								<a href="#">How to write a cover letter.</a>
							</li>
							<li>
								<a href="#">What are employers looking for?</a>
							</li>
							<li>
								<a href="#">Preparing for an interview</a>
							</li>
							<li>
								<a href="/applicant/shortlists">View all shortlist</a>
							</li>
						</ul>
					</div>
				</aside>
		</div>
	</form>
	<!-- Modal Create Group -->
	<div id="login-modal" class="modal hide fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="create-group-label" aria-hidden="true">
		<div class="modal-header">

			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Please Login to Shortlist</h3>
		</div>
		@if ( $is_employer ) 
		<div class="modal-body">
			
			You are currently logged in as an employer. The shortlist function is only to available to applicants.
			
		</div>
		@else 
		<form  class="modal-body form-horizontal validate-form" action="/login" method="post">
			<div class="control-group">
				<label class="control-label" for="username">Email</label>
				<div class="controls">
					<input class="validate[required]" type="text" id="username" placeholder="Email" name="username">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="password">Password</label>
				<div class="controls">
					<input  class="validate[required]" type="password" id="password" placeholder="Password"  name="password">
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn btn-primary">Sign in</button>
				</div>
			</div>
		</form>
		@endif

		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>



	</div>
	<!-- /#wrapper -->
	@include('layout.footer')
	@include ('layout.footer-scripts')
</body>

</html>