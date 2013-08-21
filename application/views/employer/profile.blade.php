@layout('layout.employer')
@section('page-id')page-profile@endsection
@section('content')
<div class='row'>
	
	

<h2 class='span12'>My Account</h2>
<br/>
@if ( $errors->all(':message') )
<div class="span12 validation error">
	<p>Please correct the following errors</p>
	<ul>
		@foreach($errors->all(':message') as $message)
		<li>{{ $message }}</li>
		@endforeach
	</ul>
</div>
@endif

@if (Session::get('success')) 
<div class="span12 validation success">
	<p>Your profile has been successfully updated.</p>
</div>
@elseif(Session::get('error'))
<div class="span12 validation success">
	<p>Something just happened incorrectly on the server side.</p>
</div>
@endif
{{ Form::open_for_files('employer/profile', 'post', array('class' => 'employer-form  validate-form form span8', 'id' => 'employer-profile')); }}
<div class="white-bg drop-shadow-butterfly ">
	 <h4>Company Logo</h4>
	 <div class="pad">
		 <div class="validation error" id='logo-validation'>
			
		 </div>
		 <ul>
			<li>
				{{ Form::label('company-logo', 'Current Company Logo'); }}
				<span class="btn btn-success fileinput-button">
					<i class="icon-plus icon-white"></i>
					<span>Upload / Change Logo</span>
					<!-- The file input field used as target for the file upload widget -->
					<input id="company-logo" type="file" name="company-logo" multiple>

				</span>
				<div id="progress" class="progress progress-success progress-striped">
					<div class="bar"></div>
				</div>
				<table id='files' class='files'>
					@if ( !empty($employer->logo_path) )
					<tr>
						<td><img height='30px' id='logo' src="{{$employer->logo_path}}" /></td>
						<td>{{ substr( strrchr( $employer->logo_path, '/' ), 1 )}}</td>
						<td><a class="btn logo" href="{{$employer->logo_path}}">Preview full size</a></td>

					</tr>
					@endif
				</table>				


			</li>
		 </ul>
	 </div>
</div>
<div class="white-bg drop-shadow-butterfly">
	<h4>Login Information</h4>
    <div class="pad">
		<ul>
			<li>{{ Form::label('username', 'Username'); echo Form::label('username', $user->username) }}</li>
			<li>{{ Form::label('email', 'Email'); echo Form::text('email', $user->email, array('class' => 'validate[required, custom[email]]')) }}</li>
			<li>{{ Form::label('old-password', 'Old Password'); echo Form::password('old-password', array('class' => '', 'placeholder' => 'Old Password')) }}</li>
			<li>{{ Form::label('password', 'New Password'); echo Form::password('password', array('class' => '', 'placeholder' => 'New Password')) }}</li>
			<li>{{ Form::label('password_confirmation', 'Confirm New Password'); echo Form::password('password_confirmation', array('class' => '', 'placeholder' => 'Confirm New Password')) }}</li>
		</ul>
	</div>
    <div class="clearfix"></div>	
</div>

<div class="white-bg drop-shadow-butterfly">
    <h4>Company and Contact Information</h4>
	<div class="pad">
		<ul>
			<li>{{ Form::label('company', 'Company'); echo Form::text('company', $employer->company, array('class' => 'validate[required]')) }}</li>
			<li>{{ Form::label('industry', 'Industry'); echo Form::select('industry', $categories ,$employer->industry, array('class' => 'validate[required]')) }}</li>
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
			<li>{{ Form::submit("Update", array('class' => 'btn btn-warning pull-right')); }} </li>		
		</ul>
	</div>
    <div class="clearfix"></div>
</div>

{{ Form::close(); }}
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title">Company Logo</h3>
    </div>
    <div class="modal-body">
		
		<div class="modal-image">
			<img id="modal-image-target" />
		</div>
		
	</div>
    
</div>
</div>
@endsection


@section('scripts')
<script src="/js/vendor/jquery.ui.widget.js"></script>
<!-- The File Upload processing plugin -->
<script src="/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/js/jquery.fileupload.js"></script>
@endsection