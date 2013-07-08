@layout('layout.level2')



@section('content')
@if ( $errors->all(':message') )
<div class="validation error">
	<p>Please correct the following errors:</p>
	<ul>
		@foreach($errors->all(':message') as $message)
		<li>{{ $message }}</li>
		@endforeach
	</ul>
</div>

@endif

<section id="emp-register">
	{{ Form::open('employer/register', 'POST', array('class' => 'employer-register-form  validate-form form  row')); }}
	<h2 class="span12" >Start Recruiting on Careershire</h2>
	<div class="span6 white-bg drop-shadow-butterfly">
		<h4>Account Information</h4>
		<div class='pad'>
			<ol>
				<!--<li>{{ Form::label('username', 'Username'); echo Form::text('username', Input::old('username'), array('class' => 'validate[required]')) }}</li>-->
				<li>{{ Form::label('email', 'Email'); echo Form::text('email', Input::old('email'), array('class' => 'validate[required, custom[email]]')) }}</li>
				<li>{{ Form::label('password', 'Password'); echo Form::password('password', array('class' => 'validate[required]')) }}</li>
				<li>{{ Form::label('password_confirmation', 'Confirm Password'); echo Form::password('password_confirmation', array('class' => 'validate[required]')) }}</li>
			</ol>
		</div>
	</div>
	<div class="span6 white-bg drop-shadow-butterfly">
		<h4>Company and Contact Information</h4>

		<div class='pad'>
		<ol>
			<li>{{ Form::label('company', 'Company'); echo Form::text('company', Input::old('company'), array('class' => 'validate[required]')) }}</li>
			<li>{{ Form::label('industry', 'Industry'); echo Form::select('industry', $industries,Input::old('industry')) }}</li>
			<li>{{ Form::label('title', 'Title'); echo Form::select('title', array('Mr' => 'Mr', 'Ms' => 'Ms', 'Miss' => 'Miss', 'Dr' => 'Dr'), Input::old('title')) }}</li>
			<li>{{ Form::label('firstname', 'First Name'); echo Form::text('firstname', Input::old('firstname'), array('class' => 'validate[required]')) }}</li>
			<li>{{ Form::label('lastname', 'Last Name'); echo Form::text('lastname', Input::old('lastname'), array('class' => 'validate[required]')) }}</li>
			<li>{{ Form::label('app-email', "Applicant's Email"); echo Form::text('app-email', Input::old('app-email'), array('class' => 'validate[required, custom[email]]')) }}</li>
			<li>{{ Form::label('contact', 'Contact'); echo Form::text('contact', Input::old('contact'), array('class' => 'validate[required]')) }}</li>
			<li>{{ Form::label('fax', 'Fax'); echo Form::text('fax', Input::old('fax')) }}</li>
			<li>{{ Form::label('address', 'Address'); echo Form::text('address', Input::old('address'), array('class' => 'validate[required]')) }}</li>
			<li>{{ Form::label('address2', 'Address 2'); echo Form::text('address2', Input::old('address2')) }}</li>
			<li>{{ Form::label('suburb', 'Suburb'); echo Form::text('suburb', Input::old('suburb'), array('class' => 'validate[required]')) }}</li>
			<li>{{ Form::label('postal', 'Postal'); echo Form::text('postal', Input::old('postal'), array('class' => 'validate[required]')) }}</li>
			<li>{{ Form::label('country', 'Country'); echo Form::select('country', $countries, Input::old('country')) }}</li>
			<li>{{ Form::label('company-size', 'Number of employees'); echo Form::select('company-size', array('1 - 10', '10 - 20', '20 - 30', '30 - 40', '50 - 100', '100 - 200', '> 200') ,Input::old('company-size'), array('class' => 'validate[required]')) }}</li>
			<li>{{ Form::submit("Register", array('class' => 'btn btn-warning pull-right')); }} </li>		
		</ol>
		</div>
	</div>
	{{ Form::close(); }}
</section>




@endsection
