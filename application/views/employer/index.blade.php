@layout('layout.level2')



@section('content')


<div class="span12">
	
	<h1>Post with Careershire at a cheaper price!</h1>
	<div class="wrapper">
		
		<div class="row">
			
			<div class="span9">
				@if( Auth::check() && Auth::user()->is_employer() )
				<h2></h2>
				<div class='pricing row'>
					
					<div class='span3 white-bg drop-shadow'>
						<h4>The Quicky</h4>
						<p>Fast and Hassle free. 1 ad post only</p>
						<span class='startprice'>ONLY AUD</span>
						<p class='startamt' style='left: 66px;'>$99</p>
						<p class='startcents'>.00</p>
						<div class='bottom'>
						<a class='btn btn-warning' href='/employer/plans/purchase/quicky'>Purchase NOW</a>
						</div>
					</div>
					<div class='span3 white-bg drop-shadow'>
						<h4 class='orange'>The Ideal</h4>
						<p>Save up to 15% when you select this plan. 3 ads posts</p>
						<span class='startprice'>ONLY AUD</span>
						<p class='startamt'>$245</p>
						<p class='startcents'>.00</p>
						<div class='bottom'>
							<a class='btn btn-warning' href='/employer/plans/purchase/ideal'>Purchase NOW</a>
						</div>
						
					</div>
					<div class='span3 white-bg drop-shadow'>
						<h4>Mega bulk</h4>
						<p>Save up to 20% when you select this plan. 10 ads post</p>
						<span class='startprice'>ONLY AUD</span>
						<p class='startamt'>$792</p>
						<p class='startcents'>.00</p>
						<div class='bottom'>
							<a class='btn btn-warning' href='/employer/plans/purchase/mega_bulk'>Purchase NOW</a>
						</div>
					</div>
				</div>
				@else
				<h3>Support Us!</h3>
				<p>Careershire is in its "Beta" phase and will be launching soon. We need your support!</p>
				<a class='btn btn-large btn-warning' href='/employer/register'>Sign up for free!</a>
				@endif
			</div>
			<div class="span3">
				
				@if( Auth::check() && Auth::user()->is_employer() )
				<div>
					<h3>Welcome {{Auth::user()->employer->first_name}}</h3>
					
					<ul>
						<li><a href='/employer/post/list/'>View my ads</a></li>
						<li><a href='/employer/post/create/'>Create a new ad</a></li>
						<li><a href='/employer/profile/'>Update my information</a></li>
					</ul>
				</div>
				@else
				<h2>Already Registered?</h2>
				<form class="validate-form white-bg drop-shadow-butterfly" action="/login" method="post">
					<div class="pad">
					<ol>
						<li>{{ Form::label('username', 'Username'); echo Form::text('username', Input::old('username') , array('class' => 'validate[required]')); }}</li>
						<li>{{ Form::label('password', 'Password'); echo Form::password('password' ,  array('class' => 'validate[required]')); }} {{ Form::submit("Login" , array('class' => 'btn btn-warning pull-right', 'style' => 'margin-top: 0')); }}</li>
						<li><a class="reset-pwd" href="/resetpassword">Can't access your account? Reset your password</a></li>
					</ol>
						<div class="clearfix"></div>
					</div>
				</form>
				@endif
				
			</div>
			
		</div>
		
	</div>
</div>



@endsection