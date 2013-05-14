@layout('layout.level2')

@section('content')
<div class="row login-form">
	@if ( Session::has('error')  ) 
	<div class="validation error">
		<p>You have signed in with the wrong credentials. Please try again. </p>
	</div>
	@endif
	<div class="form-signin white-bg drop-shadow-butterfly">
		<h1 class="container-header">Login</h1>

		{{ Form::open('login', 'POST', array('class' => 'validate-form')); }}
		<ol>
			<li>{{ Form::label('username', 'Username'); echo Form::text('username', Input::old('username') , array('class' => 'validate[required]')); }}</li>
			<li>{{ Form::label('password', 'Password'); echo Form::password('password' ,  array('class' => 'validate[required]')); }}</li>
			<li>{{ Form::submit("Login" , array('class' => 'btn btn-primary pull-right')); }}</li>	
		</ol>
		{{ Form::close(); }}
	</div>

</div>






@endsection
