@layout('layout.level2')

@section('content')

	@if ( Session::has('error')  ) 
	<div class="validation error">
		<p>You have signed in with the wrong credentials. Please try again. </p>
	</div>
	@endif
	<h1 class='span12'>Login</h1>

	{{ Form::open('login', 'POST', array('class' => ' validate-form form')); }}
	<div class='white-bg drop-shadow-butterfly span6'>
		<h4>Sign in</h4>
		<div class='pad'>
			<ol>
				<li>{{ Form::label('username', 'Username'); echo Form::text('username', Input::old('username') , array('class' => 'validate[required]')); }}</li>
				<li>{{ Form::label('password', 'Password'); echo Form::password('password' ,  array('class' => 'validate[required]')); }}</li>
				<li>{{ Form::submit("Login" , array('class' => 'btn btn-warning pull-right')); }}</li>
				<li><a class="reset-pwd" href="/resetpassword">Can't access your account? Reset your password</a></li>
			</ol>
			<div class='clearfix'></div>
		</div>
	</div>

	{{ Form::close(); }}









@endsection
