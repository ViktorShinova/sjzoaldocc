@layout('layout.level2')



@section('content')

{{ Form::open_for_files('applicant/register', 'POST', array('class' => 'applicant-register-form  validate-form form  row')); }}

@if ( $errors->all(':message') )
<div class="validation error span12">
	<p>Please correct the following errors:</p>
	<ul>
		@foreach($errors->all(':message') as $message)
		<li>{{ $message }}</li>
		@endforeach
	</ul>
</div>
@endif

<h1 class='span12'>Registration</h1>

<div class="span6 white-bg drop-shadow">
	<h4>Personal Details</h4>
	<ol>
		<li>{{ Form::label('firstname', 'First Name'); echo Form::text('firstname', Input::old('firstname'), array('class' => 'validate[required]')) }}</li>
		<li>{{ Form::label('lastname', 'Last Name'); echo Form::text('lastname', Input::old('lastname'), array('class' => 'validate[required]')) }}</li>
		<li>{{ Form::label('location', 'Preferred Location'); echo Form::select('location', $locations, Input::old('location')) }}</li>
		<li>{{ Form::label('category', 'Preferred Job'); echo Form::select('category', $job_categories, Input::old('category')) }}</li>	
	</ol>
	<div class="clearfix"></div>
</div>

<div class="form-field span6 white-bg drop-shadow">
	<h4>Login Information</h4>
	<ol>
		<!--<li>{{ Form::label('username', 'Username'); echo Form::text('username', Input::old('username'), array('class' => 'validate[required]')) }}</li>-->
		<li>{{ Form::label('email', 'Email'); echo Form::text('email', Input::old('email'), array('class' => 'validate[required, custom[email]]')) }}</li>
		<li>{{ Form::label('password', 'Password'); echo Form::password('password', array(), array('class' => 'validate[required]')) }}</li>
		<li>{{ Form::label('password_confirmation', 'Confirm Password'); echo Form::password('password_confirmation', array(), array('class' => 'validate[required]')) }}</li>
	</ol>
	<div class="clearfix"></div>	
</div>

{{ Form::submit("Register", array('class' => 'btn btn-primary pull-right')); }} 


{{ Form::close(); }}
@endsection
