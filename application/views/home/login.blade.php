@layout('layout.level2')

@section('content')

	@if ( Session::has('error')  ) 
	<div class="validation error">
		<p>You have signed in with the wrong credentials. Please try again. </p>
	</div>
	@endif
	

	{{ Form::open('login', 'POST', array('class' => ' validate-form form login-form')); }}
	<h4>Login</h4>
	<div class="form-horizontal span6 ">
		<div class="control-group">
			<label class="control-label" for="username">Email:</label>
			<div class="controls">
				{{Form::text('username', Input::old('username') , array('class' => 'validate[required]')); }}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password:</label>
			<div class="controls">
				{{Form::password('password' ,  array('class' => 'validate[required]')); }}
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				{{ Form::submit("Login", array('class' => 'btn')); }} 
			</div>
		</div>
		<a class="reset-pwd" href="/resetpassword">Can't access your account? Reset your password</a>
	</div>
	
	

	{{ Form::close(); }}









@endsection
