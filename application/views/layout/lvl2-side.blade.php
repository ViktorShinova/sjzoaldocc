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
	</head>

<body id="search-page">
	
	@include ('layout.header')
	<form method="get" action="/job/search">	
		<div class="container">
			<div class="row">
				<section id="job-search" class="span12">
					<div class="row form-horizontal">
						<div class="span6">

							<div class="control-group">
								<label class="control-label" for="job-keywords">Keywords:</label>
								<div class="controls">
									{{ Form::text( 'keywords', $keywords, array( 'class'=> 'span2', 'placeholder' => 'Keywords', 'id' => 'keywords', 'class' => 'input-xlarge' ) ) }}
								</div>
							</div>
							<div class="control-group">

								<label for="job-category" class="control-label">Industry:</label>
								<div class="controls">

									{{ Form::select('job-category', $categories, $selected_category , array('class' => 'input-xlarge', 'id' =>'job-category')); }}

								</div>
							</div>
							<div class="control-group">
								<label for="job-sub-category" class="control-label">Position:</label>
								<div class="controls">
									
									{{ Form::select('job-sub-category', $sub_categories, $selected_sub_category, array('class' => 'input-xlarge', 'id' =>'job-sub-category')); }}

								</div>
							</div>
							<div class="control-group"> 
								<label class="control-label">Salary Range:</label>
								<div class="controls">

									<div class="input-prepend">
										<span class="add-on">$</span>
										{{ Form::select('min-salary', $min_salary , $selected_min_salary, array('class' => 'span1', 'id'=>'min-salary')); }}

									</div>
									<div class="input-prepend">
										<span class="add-on">$</span>
										{{ Form::select('max-salary', $max_salary , $selected_max_salary, array('class' => 'span1', 'id'=>'max-salary')); }}
									</div>
									<div class="input-prepend">
										
										{{ Form::select('salary-type', array('annually' => 'Annually', 'hourly' => 'Hourly'), $selected_salary_type, array('class' => 'span1', 'id'=>'salary-type')); }}

									</div>
									
								</div>
							</div>
						</div>
						<div class="span6">
							<div class="control-group">
								<label for="job-location" class="control-label">Location:</label>
								<div class="controls">
									{{ Form::select('job-location', $locations,  $selected_location, array('class' => 'input-xlarge', 'id'=>'job-location')); }}
								</div>
							</div>
							<div class="control-group">
								<label for="job-sub-location" class="control-label">Refined Location:</label>
								<div class="controls">
									{{ Form::select('job-sub-location', $sub_locations, $selected_sub_location, array('class' => 'input-xlarge', 'id'=>'job-sub-location')); }}
								</div>
							</div>
							<div class="control-group">
								<label for="work-type" class="control-label">Work Type:</label>
								<div class="controls">
									{{ Form::select('work-type[]', $work_types, $selected_work_types, array('class' => 'input-xlarge', 'multiple' => 'multiple', 'id' => 'work-type')); }}
								</div>

							</div>
						</div>
						<button type="submit" id="search"class="btn btn-primary btn-large">Search</button>
				</section>
			</div>
		</div>
		<div id="content" class="container">
			<div class="row">
				<div class="span12">
					@yield('content')
				</div>
			</div>
		</div>
	</form>
	<!-- Modal Create Group -->
	<div id="login-modal" class="modal hide fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="create-group-label" aria-hidden="true">
		<div class="modal-header">

			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Please Login</h3>
			<p>Do more by signing up with us!<p>
		</div>
		@if ( $is_employer ) 
		<div class="modal-body">
			
			You are currently logged in as an employer. The function requested is only to available to applicants.
			
		</div>
		@else 
		<form  class="modal-body form-horizontal  validate-form form " action="/login" method="post">
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
					<button type="submit" class="btn btn-warning">Sign in</button>
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