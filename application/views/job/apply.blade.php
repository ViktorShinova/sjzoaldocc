@layout('layout.level2')

@section('custom_styles')
@if(isset($job->template)) 
<style>
	{{ $job->template->css }}
</style>
@endif
@endsection

@section('content')

@if ( Session::get('success') )
<div class="alert fade in alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	You have successfully applied for this job!
</div>
@elseif ($is_applied )
<div class="alert fade in alert-danger">
	You have already applied for this job!
</div>
@endif
@if ( $is_employer )
<div class="alert fade in alert-danger">
	You are logged in as an employer. Application should only be submitted by applicants only. Please login as an applicant before continuing with the application process. Thank you very much.
</div>
@endif
<div class="row">

	<h2 class="span12">Application Form</h2>
	<div class="span4 white-bg drop-shadow-butterfly">
		@if ( $errors->all(':message') )
			<div class="validation error">
				@foreach($errors->all('<p>:message</p>') as $message)
				{{ $message }}
				@endforeach
			</div>
		@endif
		{{ Form::open_for_files('job/apply/'.$job->id, 'POST', array('id' => 'job-apply', 'class' => ' validate-form form ')); }}
		<h4>Your Details</h4>
		<div class="pad">
			<ol>
				<li>
					<label for="email">First Name *</label>
					
					<input type="text" class="validate[required]" type="text" name="first_name" id="first_name"  value="{{ ($applicant) ? $applicant->first_name : Input::old('first_name') }}">
				</li>
				<li>
					<label for="contact">Last Name *</label>
					<input type="text" class="validate[required]" type="text" name="last_name" id="last_name"  value="{{ ($applicant) ? $applicant->last_name : Input::old('last_name')  }}">
				</li>
				<li>
					<label for="email">Email *</label>
					<input type="email" class="validate[required,custom[email]]" type="text" name="email" id="email" value="{{ ($applicant) ? $applicant->email : Input::old('email') }}">
				</li>
				<li>
					<label for="contact">Contact Number *</label>
					<input type="text" class="validate[required,custom[number]]" type="text" name="contact" id="contact" value="{{ Input::old('contact') }}">
				</li>
				<li>
					<label for="current_employment">Current Employment *</label>
					<input type="text" class="validate[required]" type="text" name="current_employment" id="current_employment" value="{{ Input::old('current_employment') }}">
				</li>
				<li>
					<label for="contact">Duration *</label>
					{{Form::select('duration_year', $years ,Input::old('duration_year'), array('class' => 'date'))}}
					{{Form::select('duration_month', $months, Input::old('duration_month'), array('class' => 'date')) }}
					
				</li>
				
				<li><hr></li>
				<li>
					<label for="resume">Resume</label>
					<div class="btn-group">
						<button class="btn dropdown-toggle" id="drop-resume" role="button" data-toggle="dropdown">No resume <b class="caret"></b></button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="drop-resume">
							@if($is_applicant)	
							@foreach ($resumes as $resume)
							<li role="presentation">
								<a class="resume-btn" href="#" data-value="{{ $resume->id }}">{{ $resume->resume }}</a>
							</li>
							@endforeach
							@endif
							<li role="presentation">
								<a class="resume-btn" href="#" data-value="0">No resume</a>
							</li>
							<li role="presentation" class="divider"></li>
							<li role="presentation">
								<a class="resume-btn" href="javascript:void(0);" id="upload-resume-link">Attach a resume</a>
								<input type="file" id="upload-resume" name="upload-resume"/>
							</li>
						</ul>
					</div>
					@if( $is_applicant )
					<label id="add-resume-to-account" class="checkbox"><input type="checkbox" name="add-resume-to-account" value="1" />Add to my account</label>
					@endif
					<input id="select-resume" name="selected-resume" type="hidden" value="0" />

				</li>

				<li><hr></li>

				<li>
					<label for="coverletter">Cover Letter</label>
					<div class="btn-group">		
						<button class="btn dropdown-toggle" id="drop-coverletter" role="button" data-toggle="dropdown">No coverletter <b class="caret"></b></button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="drop-coverletter">
							@if($is_applicant)	
							@foreach ($coverletters as $coverletter)
							<li role="presentation">
								<a class="cover-btn" href="#" data-value="{{ $coverletter->id }}">{{ $coverletter->coverletter }}</a>
								<!--<input type="radio" name="select_coverletter" value="{{ $coverletter->id }}"> <span class="coverletter-name"></span>-->
							</li>
							@endforeach
							@endif
							<li role="presentation">
								<a id="cover-write" href="#" data-value="1">Write one</a>

							</li>
							<li role="presentation">
								<a class="cover-btn" href="#" data-value="0">No coverletter</a>

							</li>
							<li role="presentation" class="divider"></li>
							<li role="presentation">
								<a class="cover-btn" href="javascript:void(0);" id="upload-coverletter-link">Attach a coverletter</a>
								<input type="file" id="upload-coverletter" name="upload-coverletter"/>
							</li>
						</ul>
					</div>
					@if( $is_applicant )
					<label id="add-coverletter-to-account" class="checkbox"><input type="checkbox" name="add-coverletter-to-account" value="1" />Add to my account</label>
					@endif
					<input id="select-coverletter" name="selected-coverletter" type="hidden" value="0" />
				</li>
				<li>
					<textarea type="text" name="write-coverletter" id="write-coverletter"></textarea>
				</li>
				@if(!$is_applied && !$is_employer)
				<li><button class="btn btn-primary" type="submit" id="apply-job-btn">Apply</button></li>
				@endif
			</ol>

		</div>
		{{ Form::close(); }}
	</div>

	<section class="notice-container span8 white-bg drop-shadow-butterfly">
		<header class="notice-header">
			<h1>{{ $job->title }}</h1>
		</header>
		<article class="notice-body">
			{{ $job->description }}
		</article>
		<footer class="notice-footer">
			{{ $job->contact }}
		</footer>
	</section>

</div>
@endsection