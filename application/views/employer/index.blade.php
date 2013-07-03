@layout('layout.level2')



@section('content')


<div class="span12">
	
	<h1>Welcome to Careershire (Advertiser Portal)</h1>
	<div class="wrapper">
		
		<div class="row">
			
			<div class="span7">
				<h3>Support Us!</h3>
				<p>Careershire is in its "Beta" phase and will be launching soon. We need your support!</p>
				<a class='btn btn-large btn-warning' href='/employer/register'>Sign up for free!</a>
			</div>
			<div class="span4">
				<h2>Already Registered?</h2>
				<form class="validate-form white-bg drop-shadow-butterfly" action="/login" method="post">
					<div class="pad">
					<ol>
						<li>{{ Form::label('username', 'Username'); echo Form::text('username', Input::old('username') , array('class' => 'validate[required]')); }}</li>
						<li>{{ Form::label('password', 'Password'); echo Form::password('password' ,  array('class' => 'validate[required]')); }} {{ Form::submit("Login" , array('class' => 'btn btn-primary pull-right', 'style' => 'margin-top: 0')); }}</li>
						<li><a class="reset-pwd" href="/resetpassword">Can't access your account? Reset your password</a></li>
					</ol>
						<div class="clearfix"></div>
					</div>
				</form>
			</div>
			
		</div>
		
	</div>
</div>



@endsection