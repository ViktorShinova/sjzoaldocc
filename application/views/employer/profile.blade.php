@layout('layout.employer')
@section('page-id')page-profile@endsection
@section('content')

<h1 class="container-header">My Account</h1>
<div class="content">
    @if ( $errors->all(':message') )
    <div class="validation error">
        <p>Please correct the following errors</p>
        <ul>
            @foreach($errors->all(':message') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    @if (Session::get('success')) 
    <div class="validation success">
        <p>Your profile has been successfully updated.</p>
    </div>
    @elseif(Session::get('error'))
    <div class="validation success">
        <p>Hohoho something is wrong .....</p>
    </div>
    @endif
    {{ Form::open_for_files('employer/profile', 'post', array('class' => 'employer-form  validate-form form ', 'id' => 'employer-profile')); }}
    <h4>Login Information</h4>
    <ul>
        <li>{{ Form::label('username', 'Username'); echo Form::label('username', $user->username) }}</li>
        <li>{{ Form::label('email', 'Email'); echo Form::text('email', $user->email, array('class' => 'validate[required, custom[email]]')) }}</li>
        <li>{{ Form::label('old-password', 'Old Password'); echo Form::password('old-password', array('class' => '', 'placeholder' => 'Old Password')) }}</li>
        <li>{{ Form::label('password', 'New Password'); echo Form::password('password', array('class' => '', 'placeholder' => 'New Password')) }}</li>
        <li>{{ Form::label('password_confirmation', 'Confirm New Password'); echo Form::password('password_confirmation', array('class' => '', 'placeholder' => 'Confirm New Password')) }}</li>
    </ul>
    <div class="clearfix"></div>	
    <h4>Company and Contact Information</h4>
    <ul>
		<li>
			{{ Form::label('company-logo', 'Current Company Logo'); echo Form::file('company-logo') }}
			
			@if ( !empty($employer->logo_path) )
				<img id='logo' src="{{$employer->logo_path}}" />
			@else
				<img id='logo' src="http://placehold.it/500x150/ff4d6d" />
			@endif
			<a href="#" data-toggle="tooltip" title="The reason for us to get a larger image from you is due to our responsive design and our support for retina display on iPads and iPhones. You can of course choose a smaller image. However, in some cases, such image may appear to be a little 'pixelated'." class="tool-tip clearfix">Why do you need such a big image?</a>


		</li>
        <li>{{ Form::label('company', 'Company'); echo Form::text('company', $employer->company, array('class' => 'validate[required]')) }}</li>
        <li>{{ Form::label('industry', 'Industry'); echo Form::text('industry', $employer->industry, array('class' => 'validate[required]')) }}</li>
        <li>{{ Form::label('title', 'Title'); echo Form::select('title', array('Mr' => 'Mr', 'Ms' => 'Ms', 'Miss' => 'Miss', 'Dr' => 'Dr'), $employer->title) }}</li>
        <li>{{ Form::label('firstname', 'First Name'); echo Form::text('firstname', $employer->first_name, array('class' => 'validate[required]')) }}</li>
        <li>{{ Form::label('lastname', 'Last Name'); echo Form::text('lastname', $employer->last_name, array('class' => 'validate[required]')) }}</li>
        <li>{{ Form::label('app-email', "Applicant's Email"); echo Form::text('app-email', $employer->application_email, array('class' => 'validate[required, custom[email]]')) }}</li>
        <li>{{ Form::label('contact', 'Contact'); echo Form::text('contact', $employer->contact, array('class' => 'validate[required]')) }}</li>
        <li>{{ Form::label('fax', 'Fax'); echo Form::text('fax', $employer->fax ) }}</li>
        <li>{{ Form::label('address', 'Address'); echo Form::text('address', $employer->address, array('class' => 'validate[required]')) }}</li>
        <li>{{ Form::label('address2', 'Address 2'); echo Form::text('address2', $employer->address_2) }}</li>
        <li>{{ Form::label('suburb', 'Suburb'); echo Form::text('suburb', $employer->suburb, array('class' => 'validate[required]')) }}</li>
        <li>{{ Form::label('postal', 'Postal'); echo Form::text('postal', $employer->postal, array('class' => 'validate[required]')) }}</li>
        <li>{{ Form::label('country', 'Country'); echo Form::select('country', $countries, $employer->country ) }}</li>
        <li>{{ Form::label('company-size', 'Number of employees'); echo Form::select('company-size', array('1-10' => '1 - 10', '10-20' => '10 - 20', '20-30' => '20 - 30', '30-50' => '30 - 50', '50-100' => '50 - 100', '100-200' => '100 - 200', '>200' => '> 200') ,$employer->company_size, array('class' => 'validate[required]')) }}</li>
        <li>{{ Form::submit("Update", array('class' => 'btn btn-primary')); }} </li>		
    </ul>
    <div class="clearfix"></div>
    {{ Form::close(); }}


</div>
@endsection