@layout('layout.level2')

@section('content')
<div class="row login-form">





	{{ Form::open('resetpassword', 'POST', array('class' => ' validate-form form', 'id' => 'form-reset'	)); }}
	<h4>Reset Password</h4>

	@if ( Session::get('success')  ) 
	<div class="validation success">
		<p>Your password has been reset. Please check your email.</p>
	</div>
	@endif
	<div class="form-horizontal span6 ">
		<div class="control-group">
			<label class="control-label" for="username">Email:</label>
			<div class="controls">
				{{Form::text('email', '' , array('class' => 'validate[required]')); }}
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				{{ Form::submit("Reset", array('class' => 'btn')); }} 
			</div>
		</div>
	</div>
	
	{{ Form::close(); }}


</div>




@endsection
