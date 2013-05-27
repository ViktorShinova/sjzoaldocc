@layout('layout.level2')

@section('content')

{{ Form::open('employer/login', 'POST', array('class' => 'employer-login-form  validate-form form ')); }}
<div class="form-field span9">
	<h1 class="container-header">Login</h1>
	<ol>
		<li>{{ Form::label('username', 'Username'); echo Form::text('username', Input::old('username') , array('class' => 'validate[required]')); }}</li>
		<li>{{ Form::label('password', 'Password'); echo Form::password('password' ,  array('class' => 'validate[required]')); }}</li>
		<li> {{ Form::submit("Login" , array('class' => 'btn btn-primary pull-right')); }} </li>	
	</ol>
</div>

{{ Form::close(); }}


@endsection
