@layout('layout.level2')

@section('content')
<div class="row login-form">
	
	
	<div class="white-bg drop-shadow-butterfly  form-inline">
		

		{{ Form::open('resetpassword', 'POST', array('class' => ' validate-form form', 'id' => 'form-reset'	)); }}
		<h4>Reset Password</h4>
		<div class='pad'>
		@if ( Session::get('success')  ) 
			<div class="validation success">
			<p>Your password has been reset. Please check your email.</p>
		</div>
		@endif
			{{ Form::label('email', 'Email Address'); echo Form::text('email', '' , array('class' => 'validate[required]')); }} {{ Form::submit("Reset Password" , array('class' => 'btn btn-warning')); }}
		</div>
		{{ Form::close(); }}
	</div>

</div>






@endsection
