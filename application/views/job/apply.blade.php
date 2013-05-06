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
@endif

<div class="row">

	<section class="span6 white-bg drop-shadow">
		
		

			{{ Form::open_for_files('job/apply/'.$job->id, 'POST', array('id' => 'job-apply', 'class' => 'validate-form')); }}
			<h2 class="container-header">Application Form</h2>
			<div>
			@if($is_applicant)	
			<div class="alert">
				<p>
					You are logged in as <a href="/applicant/profile/victorlimys/{{ $applicant->slug }}">{{ $applicant->first_name }} {{ $applicant->last_name }}</a>. Your application will be reviewed <strong>using your <a href="/applicant/profile/victorlimys/{{ $applicant->slug }}">profile</a></strong>.
				</p>

				<p>You may edit your <a href="/applicant/settings">privacy</a> settings if you wish to choose what to be shown.</p>
			</div>
			@endif
			
				<h4>Your Details</h4>
				<ol>
					@if(!$is_applicant)	
					<li>
						<label for="email">First Name *</label>
						<input type="text" class="validate[required]" type="text" name="first_name" id="first_name">
					</li>
					<li>
						<label for="contact">Last Name *</label>
						<input type="text" class="validate[required]" type="text" name="last_name" id="last_name">
					</li>
					@endif
					<li>
						<label for="email">Email *</label>
						<input type="email" class="validate[required,custom[email]]" type="text" name="email" id="email" value="{{ $applicant->email }}">
					</li>
					<li>
						<label for="contact">Contact Number *</label>
						<input type="text" class="validate[required,custom[number]]" type="text" name="contact" id="contact" value="{{ $applicant->contact_number }}">
					</li>
					<li><hr></li>
					<li>
						<label for="resume">Resume</label>
						<div class="btn-group">
							<button class="btn dropdown-toggle" id="drop-resume" role="button" data-toggle="dropdown" href="#">Select an option <b class="caret"></b></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="drop-resume">
								@if($is_applicant)	
									@foreach ($resumes as $resume)
									<li role="presentation">
										<input type="radio" name="select_resume" value="{{ $resume->id }}"> <span class="resume-name">{{ $resume->resume }}</span>
									</li>
									@endforeach
								@endif
								<li role="presentation">
									<input type="radio" name="select_resume"> <span class="resume-name">Write one</span>
								</li>
								<li role="presentation">
									<input type="radio" name="select_resume" value="0" checked="checked"> <span class="resume-name">No resume</span>
								</li>
								<li role="presentation" class="divider"></li>
								<li role="presentation">
									<a href="javascript:void(0);" id="upload-resume-link">Upload a resume</a>
									<input type="file" id="upload-resume" name="upload-resume"/>
								</li>
							</ul>
						</div>
					</li>
					<li>
						<label for="write-resume"></label>
						<textarea type="text" name="write-resume" id="write-resume"></textarea>
					</li>

					<li><hr></li>
					
					<li>
						<label for="coverletter">Cover Letter</label>
						<div class="btn-group">		
							<button class="btn dropdown-toggle" id="drop-coverletter" role="button" data-toggle="dropdown" href="#">Select an option <b class="caret"></b></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="drop-coverletter">
								@if($is_applicant)	
									@foreach ($coverletters as $coverletter)
									<li role="presentation">
										<input type="radio" name="select_coverletter" value="{{ $coverletter->id }}"> <span class="coverletter-name">{{ $coverletter->coverletter }}</span>
									</li>
									@endforeach
								@endif
								<li role="presentation">
									<input type="radio" name="select_coverletter" value="0"> <span class="coverletter-name">Write one</span>
								</li>
								<li role="presentation">
									<input type="radio" name="select_coverletter" value="0" checked="checked"> <span class="coverletter-name">No coverletter</span>
								</li>
								<li role="presentation" class="divider"></li>
								<li role="presentation">
									<a href="javascript:void(0);" id="upload-coverletter-link">Upload a coverletter</a>
									<input type="file" id="upload-coverletter" name="upload-coverletter"/>
								</li>
							</ul>
						</div>
					</li>
					<li>
						<label for="write-coverletter"></label>
						<textarea type="text" name="write-coverletter" id="write-coverletter"></textarea>
					</li>
					@if($is_applied)
					<li><a href="javascript:void(0);" class='btn pull-right'>You have applied for this job</a></li>
					@else
					<li><button class="btn btn-primary" type="submit" id="apply-job-btn">Apply</button></li>
					@endif
				</ol>
			</div>
			{{ Form::close(); }}
	</section>

	<section class="notice-container span6 white-bg drop-shadow">
		<header class="notice-header">
			<h1>{{ $job->title }}</h1>
		</header>
		<article class="notice-body">
			{{ $job->description }}
		</article>
		<footer class="notice-footer">
			Your contact details or any other information.
		</footer>
	</section>
		
</div>
@endsection