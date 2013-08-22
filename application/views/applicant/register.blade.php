@layout('layout.level2')



@section('content')

{{ Form::open_for_files('applicant/register', 'POST', array('class' => 'validate-form row register-form')); }}

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
<h1 class='span12'>Join us to enhance your career</h1>

<h4>Personal Details</h4>
<div class="form-horizontal span6">
	<div class="control-group">
		<label class="control-label" for="firstname">First Name:</label>
		<div class="controls">
			{{Form::text('firstname', Input::old('firstname'), array('class' => 'validate[required] input-xlarge')) }}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="lastname">Last Name:</label>
		<div class="controls">
			{{Form::text('lastname', Input::old('lastname'), array('class' => 'validate[required] input-xlarge')) }}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="location">Preferred Location:</label>
		<div class="controls">
			{{Form::select('location', $locations, Input::old('location'), array('class' => 'input-xlarge')) }}
		</div> 
	</div>
	<div class="control-group">
		<label class="control-label" for="category">Preferred Job:</label>
		<div class="controls">
			{{ Form::select('category', $job_categories, Input::old('category'), array('class' => 'input-xlarge'))}}
		</div>
	</div>
</div>
<h4>Login Information</h4>
<div class="form-horizontal span6">
	<div class="control-group">
		<label class="control-label" for="email">Email:</label>
		<div class="controls">
			{{Form::text('email', Input::old('email'), array('class' => 'validate[required, custom[email]] input-xlarge')) }}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password">Passowrd:</label>
		<div class="controls">
			{{Form::password('password', array('class' => 'validate[required] input-xlarge')) }}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password_confirmation">Confirm password:</label>
		<div class="controls">
			{{Form::password('password_confirmation', array('class' => 'validate[required] input-xlarge')) }}
		</div>
	</div>
	
	<div class="control-group">
	
		<div class="controls">
			{{ Form::submit("Register", array('class' => 'btn')); }} 
		</div>
	</div>
</div>
	




{{ Form::close(); }}
@endsection