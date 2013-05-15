@layout('layout.level2')

@section('content')

@if ( Session::get('success') )
<div class="alert fade in alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	Your profile has been saved!
</div>
@endif

<div class="row applicant">
	@if ( $errors->all(':message') )
	<div class="validation error">
		@foreach($errors->all(':message') as $message)
		<p>{{ $message }}</p>
		@endforeach
	</div>
	@endif

	<h1 class='span12'>My Profile</h1>



	{{ Form::open_for_files('applicant/account', 'POST', array('id' => 'applicant-account', 'class' => 'applicant-account-form validate-form')); }}

	<div class="span9 white-bg" id='profile-basic'>

		<h4>Basic Details</h4>

		<div id="profile-photo">
			<div id="current-photo">
				<div id="photo">

					<img id="profilepic" src="{{ $applicant->profilepic }}"><!-- class="preview" factor=1 -->

					<input type="hidden" id="x" name="x" />
					<input type="hidden" id="y" name="y" />
					<input type="hidden" id="w" name="w" />
					<input type="hidden" id="h" name="h" />

					<div id="photo-edit-btn">
						<a href="#edit-photo" role="button" data-toggle="modal" id="upload-profile-pic-link">Change</a> | <a id="p1" href="javascript:void(0);" class="remove">Remove</a>
					</div>
				</div>
				<small>(MAX. 2MB | JPG, PNG, GIF only)</small>
				<input type="file" id="upload-profile-pic" name="upload-profile-pic"/>


			</div>

			<!-- Modal Edit Photo -->
			<div id="edit-photo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-body">
					<img id="profilepic-preview" src=""  />
					<button class="btn btn-primary pull-right" id="crop-profile-pic-btn" type="button" data-dismiss="modal" aria-hidden="true">Crop</button>
					<button class="btn pull-right" data-dismiss="modal" aria-hidden="true" data-controls-modal="create-group">Cancle</button>
				</div>
			</div>
		</div>

		<ol>
			<li>{{ Form::label('firstname', 'First Name'); echo Form::text('firstname', $applicant->first_name, array('class' => 'validate[required]')) }}</li>
			<li>{{ Form::label('lastname', 'Last Name'); echo Form::text('lastname', $applicant->last_name, array('class' => 'validate[required]')) }}</li>
			<li>{{ Form::label('location', 'Preferred Location'); echo Form::select('location', $locations, $applicant->preferred_location) }}</li>
			<li>{{ Form::label('category', 'Preferred Job'); echo Form::select('category', $job_categories, $applicant->preferred_job) }}</li>
			<li>
				{{ Form::label('profile', 'Profile Url')}}
				<div id='profile-slug' class="input-prepend">
					<span class="add-on"><a id="slug-link" href="/{{$applicant->slug}}" target="_blank">{{$host}}</a></span>
					<input type="text"	 name="slug" value="{{$applicant->slug}}">
				</div>


			</li>
			<li>{{ Form::submit("Save", array('class' => 'btn btn-primary')); }} </li>	
		</ol>
		<input type="hidden" name="form-type" value="basic-profile">

	</div>
	{{ Form::close(); }}



	<div class="span9">

		<div class="accordion" id="account-edit">

			<div class="accordion-group">

				<div class="accordion-heading">

					<a class="accordion-toggle" data-toggle="collapse" data-parent="#account-edit" href="#qualifications">
						<h4>Qualifications</h4>
					</a>

				</div>
				<div id="qualifications" class="accordion-body collapse">
					<div class="accordion-inner">
						{{ Form::open('applicant/account', 'POST', array('id' => 'applicant-qualifications', 'class' => 'applicant-account-form validate-form')); }}
						
							@if (count($qualifications) > 0)	
							<?php $i = 0; ?>
							@foreach ($qualifications as $qualification)
							<ol class="qualifications-field-child">
								<li class="pull-right">
									<button class="btn btn-mini remove" type="button" id="q{{ $qualification->id }}"><i class="icon-remove"></i></button>
									<button class="btn btn-mini edit" type="button"><i class="icon-pencil"></i></button>
								</li>
								<li>
									<label for="qualification_name">Program Title</label>
									<input type="text" name="qualification[<?php echo $i; ?>][name]" value="{{ $qualification->name }}">
								</li>
								<li class="hide">
									<label for="qualification_school">School</label>
									<input type="text" name="qualification[<?php echo $i; ?>][school]" value="{{ $qualification->school }}">
								</li>
								<li class="hide">
									<label for="qualification_field_of_study">Field of Study</label>
									<input type="text" name="qualification[<?php echo $i; ?>][field_of_study]" value="{{ $qualification->field_of_study }}" placeholder="e.g. Biomedical Science Major">
								</li>
								<li class="hide">
									<label for="qualification_description">Description</label>
									<textarea name="qualification[<?php echo $i; ?>][description]">{{ $qualification->description }}</textarea>
								</li>
								<li class="hide">
									<label for="qualification_started">Year Started</label>
									<input class="span1 validate[custom[number]]" size="4" type="text" name="qualification[<?php echo $i; ?>][started]" maxlength="4" value="{{ $qualification->started }}">
								</li>
								<li class="hide">
									<label for="qualification_ended">Year Ended <small>(or expected graduated year)</small></label>
									<input class="span1 validate[custom[number]]" size="4" type="text" name="qualification[<?php echo $i; ?>][ended]" maxlength="4" value="{{ $qualification->ended }}">

									<input type="hidden" name="qualification[<?php echo $i; ?>][id]" value="{{ $qualification->id }}">
								</li>
							</ol>
							<?php $i++; ?>
							@endforeach
							@else
							<ol class="qualifications-field-child">
								<li class="pull-right">
									<button class="btn btn-mini remove" type="button" id=""><i class="icon-remove"></i></button>
									<button class="btn btn-mini edit" type="button"><i class="icon-pencil"></i></button>
								</li>
								<li>
									<label for="qualification_name">Program Title</label>
									<input type="text" name="qualification[0][name]" placeholder="e.g. Bachelor of Science">
								</li>
								<li class="hide">
									<label for="qualification_school">School</label>
									<input type="text" name="qualification[0][school]">
								</li>
								<li class="hide">
									<label for="qualification_field_of_study">Field of Study</label>
									<input type="text" name="qualification[0][field_of_study]" placeholder="e.g. Biomedical Science Major">
								</li>
								<li class="hide">
									<label for="qualification_description">Description</label>
									<textarea name="qualification[0][description]"></textarea>
								</li>
								<li class="hide">
									<label for="qualification_started">Year Attended</label>
									<input class="span1 validate[custom[number]" size="4" type="text" name="qualification[0][started]" maxlength="4">
								</li>
								<li class="hide">
									<label for="qualification_ended">Year Ended <small>(or expected graduated year)</small></label>
									<input class="span1 validate[custom[number]" size="4" type="text" name="qualification[0][ended]" maxlength="4">

									<input type="hidden" name="qualification[0][id]">
								</li>
							</ol>
							@endif
						
						{{ Form::submit("Save", array('class' => 'btn btn-primary pull-right')); }} 
						<button class="add-qualification btn pull-right" type="button"><i class="icon-plus icon-white"></i> Additional Qualification</button>
						<input type="hidden" name="form-type" value="qualification">
						{{ Form::close(); }}
					</div>
				</div>

			</div>
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#account-edit" href="#employement">
						<h4>Employment History</h4>
					</a>
				</div>
				<div id="employement" class="accordion-body collapse">
					<div class="accordion-inner">
						{{ Form::open('applicant/account', 'POST', array('id' => 'applicant-workhistory', 'class' => 'applicant-account-form validate-form')); }}

						
							@if (count($workhistories) > 0)
							<?php $i = 0; ?>
							@foreach ($workhistories as $workhistory)
							<ol class="workhistory-field-child">
								<li class="pull-right">
									<button class="btn btn-mini remove" type="button"  id="w{{ $workhistory->id }}"><i class="icon-remove"></i></button>
									<button class="btn btn-mini edit" type="button"><i class="icon-pencil"></i></button>
								</li>
								<li>
									<label for="workhistory_name">Employer's Name</label>
									<input type="text" name="workhistory[<?php echo $i; ?>][name]" value="{{ $workhistory->employer_name }}">
								</li>
								<li class="hide">
									<label for="workhistory_started">Started</label>
									<?php list($workhistory_started_year, $workhistory_started_month, $workhistory_started_day) = explode("-", $workhistory->started); ?>

									<select class="span1" name="workhistory[<?php echo $i; ?>][started_month]">
										@foreach ($months as $val => $month)
										<option value="{{ $val }}" <?php echo ($workhistory_started_month == $val) ? 'selected="selected"' : ""; ?>>{{ $month }}</option>
										@endforeach
									</select>

									<select class="span1 validate[required]" name="workhistory[<?php echo $i; ?>][started_year]">
										@foreach ($years as $year)
										<option value="{{ $year }}" <?php echo ($workhistory_started_year == $year) ? 'selected="selected"' : ""; ?>>{{ $year }}</option>
										@endforeach
									</select>
								</li>
								<li class="hide">
									<label for="workhistory_ended">Ended</label>

									<?php list($workhistory_ended_year, $workhistory_ended_month, $workhistory_ended_day) = explode("-", $workhistory->ended); ?>
									<select class="span1 workhistory_status" name="workhistory[<?php echo $i; ?>][ended_month]" <?php echo ($workhistory->currently_work_here == 1) ? 'style="display:none"' : ""; ?>>
										@foreach ($months as $val => $month)
										<option value="{{ $val }}" <?php echo ($workhistory_ended_month == $val) ? 'selected="selected"' : ""; ?>>{{ $month }}</option>
										@endforeach
									</select>

									<select class="span1 workhistory_status" name="workhistory[<?php echo $i; ?>][ended_year]" <?php echo ($workhistory->currently_work_here == 1) ? 'style="display:none"' : ""; ?>>
										@foreach ($years as $year)
										<option value="{{ $year }}" <?php echo ($workhistory_ended_year == $year) ? 'selected="selected"' : ""; ?>>{{ $year }}</option>
										@endforeach
									</select>

									<input type="checkbox" class="currenty_work_here" name="workhistory[<?php echo $i; ?>][currently_work_here]"  <?php echo ($workhistory->currently_work_here == 1) ? 'checked="checked"' : ""; ?>> <small>CURRENTLY WORK HERE</small>

									<div class="clearfix"></div>
								</li>
								<li class="hide">
									<label for="workhistory_ended">Industry</label>
									<select name="workhistory[<?php echo $i; ?>][industry]">
										<?php $n = 1; ?>
										@foreach ($industries as $industry)
										<option value="<?php echo $n; ?>" <?php echo ($workhistory->industry == $n) ? 'selected="selected"' : ""; ?>>{{ $industry }}</option>
										<?php $n++; ?>
										@endforeach
									</select>

								</li>
								<li class="hide">
									<label for="workhistory_description">Description</label>
									<textarea name="workhistory[<?php echo $i; ?>][description]">{{ $workhistory->description }}</textarea>
									<input type="hidden" name="workhistory[<?php echo $i; ?>][id]" value="{{ $workhistory->id }}">
								</li>
							</ol>
							<?php $i++; ?>
							@endforeach
							@else
							<ol class="workhistory-field-child">
								<li class="pull-right">
									<button class="btn btn-mini remove" type="button" id=""><i class="icon-remove"></i></button>
									<button class="btn btn-mini edit" type="button"><i class="icon-pencil"></i></button>
								</li>
								<li>
									<label for="workhistory_name">Employer's Name</label>
									<input type="text" name="workhistory[0][name]">
								</li>
								<li class="hide">
									<label for="workhistory_started">Started</label>
									<select class="span1" name="workhistory[0][started_month]">
										@foreach ($months as $val => $month)
										<option value="{{ $val }}">{{ $month }}</option>
										@endforeach
									</select>

									<select class="span1 validate[required]" name="workhistory[0][started_year]">
										@foreach ($years as $year)
										<option value="{{ $year }}">{{ $year }}</option>
										@endforeach
									</select>
								</li>
								<li class="hide">
									<label for="workhistory_ended">Ended</label>
									<select class="span1 workhistory_status" name="workhistory[0][ended_month]">
										@foreach ($months as $val => $month)
										<option value="{{ $val }}">{{ $month }}</option>
										@endforeach
									</select>

									<select class="span1 workhistory_status" name="workhistory[0][ended_year]">
										@foreach ($years as $year)
										<option value="{{ $year }}">{{ $year }}</option>
										@endforeach
									</select>

									<input type="checkbox" class="currenty_work_here" name="workhistory[0][currently_work_here]"> <small>CURRENTLY WORK HERE</small>

									<div class="clearfix"></div>
								<li class="hide">
									<label for="workhistory_ended">Industry</label>
									<select name="workhistory[0][industry]">
										<?php $n = 1; ?>
										@foreach ($industries as $industry)
										<option value="<?php echo $n; ?>">{{ $industry }}</option>
										<?php $n++; ?>
										@endforeach
									</select>
								</li>
								<li class="hide">
									<label for="workhistory_description">Description</label>
									<textarea name="workhistory[0][description]"></textarea>
									<input type="hidden" name="workhistory[0][id]">
								</li>
							</ol>
							@endif			
						
						{{ Form::submit("Save", array('class' => 'btn btn-primary pull-right')); }} 
						<button class="add-workhistory btn pull-right" type="button"><i class="icon-plus icon-white"></i> Additional Work History</button>
						<input type="hidden" name="form-type" value="workhistory">	

						{{ Form::close(); }}
					</div>
				</div>

			</div>
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#account-edit" href="#expertise">
						<h4>Expertise</h4>	
					</a>
				</div>
				<div id="expertise" class="accordion-body collapse">
					<div class="accordion-inner">
						<section class="form">
							<div class="span9 white-bg clearfix">
								<input type="text" class="input-xxlarge">
								<button class="btn btn-primary">Add!</button>

								<ul>
									<li>x</li>
									<li>x</li>
									<li>x</li>
								</ul>

							</div>
						</section>
					</div>
				</div>
			</div>

			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#account-edit" href="#resume">
						<h4>Resume</h4>
					</a>
				</div>
				<div id="resume" class="accordion-body collapse">
					<div class="accordion-inner">
						{{ Form::open_for_files('applicant/account', 'POST', array('id' => 'applicant-resume', 'class' => 'applicant-account-form validate-form')); }}
						<ul class="listing" id="resume-listing">
							@foreach ($resumes as $resume)
							<li class="item">
								<!--button class="btn btn-mini visibility pull-right" type="button" id="v{{ $resume->id }}"><i class="<?php echo ($resume->disabled == 0) ? 'icon-eye-open' : 'icon-eye-close'; ?>"></i></button-->
								<button class="btn btn-mini remove pull-right" type="button" id="r{{ $resume->id }}"><i class="icon-remove"></i></button>
								<a href="{{ $resume->path }}" target="_blank">
									<span class="icon {{ $resume->type }}"></span>
								</a>
								<span class="title"><a href="{{ $resume->path }}" target="_blank">{{ $resume->resume }}</a></span>
								<span class="filesize">{{ $resume->filesize }}</span>
								<span class="date-upload">{{ $resume->created_at }}</span>
							</li>
							@endforeach
						</ul>

						<button id="add-resume" class="btn btn-primary pull-right" type="button"><i class="icon-plus icon-white"></i> Resume</button>
						<input type="file" id="resume-file" name="resume-file"/>
						{{ Form::close(); }}
					</div>
				</div>
			</div>


			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#account-edit" href="#coverletter">
						<h4>Coverletters</h4>
					</a>
				</div>
				<div id="coverletter" class="accordion-body collapse">
					<div class="accordion-inner">
						{{ Form::open_for_files('applicant/account', 'POST', array('id' => 'applicant-coverletter', 'class' => 'applicant-account-form validate-form')); }}
						<ul class="listing" id="coverletter-listing">
							@foreach ($coverletters as $coverletter)
							<li class="item">
								<button class="btn btn-mini remove pull-right" type="button" id="c{{ $coverletter->id }}"><i class="icon-remove"></i></button>
								<a href="{{ $coverletter->path }}" target="_blank">
									<span class="icon {{ $coverletter->type }}"></span>
								</a>
								<span class="title"><a href="{{ $coverletter->path }}" target="_blank">{{ $coverletter->coverletter }}</a></span>
								<span class="filesize">{{ $coverletter->filesize }}</span>
								<span class="date-upload">{{ $coverletter->created_at }}</span>
							</li>
							@endforeach
						</ul>

						<button id="add-coverletter" class="btn btn-primary pull-right" type="button"><i class="icon-plus icon-white"></i> Coverletter</button>
						<input type="file" id="coverletter-file" name="coverletter-file"/>
						{{ Form::close(); }}
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.row -->

@endsection