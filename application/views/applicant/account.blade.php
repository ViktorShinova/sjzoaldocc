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



	{{ Form::open_for_files('applicant/account', 'POST', array('id' => 'applicant-account', 'class' => 'applicant-account-form  validate-form form ')); }}

	<div class="span9 white-bg drop-shadow-butterfly" id='profile-basic'>

		<h4>Basic Details</h4>

		<div id="profile-photo">
			<div id="current-photo">
				<div id="photo">

					<img id="profilepic" src="{{ $applicant->profilepic }}" alt="{{$applicant->name}}"><!-- class="preview" factor=1 -->

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
			<div id="edit-photo" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-body">
					<img id="profilepic-preview" src="#"  alt="Crop"/>
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
				{{ Form::label('profile-url', 'Profile Url')}}
				<div id='profile-slug' class="input-prepend">
					<span class="add-on"><a id="slug-link" href="/{{$applicant->slug}}" target="_blank">{{$host}}</a></span>
					<input id='profile-url' type="text"	 name="slug" value="{{$applicant->slug}}">
				</div>


			</li>
			<li>{{ Form::submit("Save", array('class' => 'btn btn-primary')); }} </li>	
		</ol>
		<input type="hidden" name="form-type" value="basic-profile">

	</div>
	{{ Form::close(); }}



	<div class="span9">

		<div class="accordion" id="account-edit">

			<div class="accordion-group drop-shadow-butterfly">

				<div class="accordion-heading">

					<a class="accordion-toggle" data-toggle="collapse" href="#qualifications">
						<h4>Qualifications</h4>
					</a>

				</div>
				<div id="qualifications" class="accordion-body collapse in">
					<div class="accordion-inner">
						<div id="qualification-list">
							@if (count($qualifications) > 0)
							<table>

								<tr>
									<th class="level">Level</th>
									<th class="title">Title</th>
									<th class="institude">Institude</th>
									<th class="started">Started</th>
									<th class="ended">Ended</th>
									<th class="control"></th>
								</tr>
								@foreach ($qualifications as $qualification)
								<tr>
									<td>{{$qualification->level}}</td>
									<td>{{$qualification->title}}</td>
									<td>{{$qualification->institude}}</td>
									<td>{{$qualification->started}}</td>
									<td>{{$qualification->ended}}</td>
									<td>
										<button title="Edit" class="btn btn-mini qedit btn-warning" type="button" data-qid="{{ $qualification->id }}"><i class="icon-pencil"></i></button>
										<button title="Delete" class="btn btn-mini qremove btn-danger" type="button" data-qid="{{ $qualification->id }}"><i class="icon-remove"></i></button>
									</td>
								</tr>
								@endforeach
							</table>
							@endif
						</div>
						<a id="add-qualification" class="btn btn-primary pull-right add" href="#qualification-form" data-toggle="modal"><i class="icon-plus icon-white"></i> Add Qualification</a>
					</div>
				</div>

			</div>

			<div class="accordion-group drop-shadow-butterfly">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" href="#employement">
						<h4>Employment History</h4>
					</a>
				</div>
				<div id="employement" class="accordion-body collapse in">
					<div class="accordion-inner">

						<div id='employment-list'>

							@if (count($experiences) > 0)
							<ul>
								@foreach ($experiences as $experience)
								<li>

									<h4>{{$experience->company_name}} 
										<button title="Delete" class="btn btn-mini btn-danger eremove pull-right" type="button" data-eid="{{ $experience->id }}"><i class="icon-remove"></i></button>
										<button title="Edit" class="btn btn-mini eedit btn-warning pull-right" type="button" data-eid="{{ $experience->id }}"><i class="icon-pencil"></i></button>
									</h4>
									<p>From: {{$experience->started_month}} {{$experience->started_year}} to 
										@if ($experience->ended_year == 1)
										Current
										@else
										{{$experience->ended_month}} {{$experience->ended_year}}
										@endif
									</p>
									<p>Industry: {{$experience->industry}}</p>
									<p>Position: {{$experience->position}}</p>
									<p>Job Scope:  {{$experience->description}}</p>
								</li>
								@endforeach
							</ul>
							@endif


						</div>

						<a id="add-employment" class="btn btn-primary pull-right add" href="#employment-form" data-toggle="modal"><i class="icon-plus icon-white"></i> Add Experience</a>

					</div>
				</div>

			</div>
			<div class="accordion-group drop-shadow-butterfly">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" href="#expertise">
						<h4>Expertise</h4>	
					</a>
				</div>
				<div id="expertise" class="accordion-body collapse in">
					<div class="accordion-inner">
						<form class="form validate-form form-horizontal" action="/applicant/expertise" id="expertise-add-form">

							<input type="text" class="input-xxlarge validate[required]" name="expertise" data-prompt-position="bottomRight">
							<button class="btn btn-primary" id="add-expertise">Add!</button>
						</form>
						<div id="expertise-list">
							<table>
								<tr>
									<th>Expertise</th>
									<th class="controls"></th>
								</tr>
								@if( count($expertises) != 0 ) 
								@foreach($expertises as $expertise)
								<tr>
									<td>
										{{$expertise}}
									</td>
									<td>
										<a href="#" class="btn btn-warning btn-mini exp-edit" data-value="{{$expertise}}"><i class="icon-pencil"></i></a>
										<a href="#" class="btn btn-danger btn-mini exp-remove" data-value="{{$expertise}}"><i class="icon-remove"></i></a>
									</td>
								</tr>
								@endforeach
								@endif
							</table>
						</div>


					</div>
				</div>
			</div>

			<div class="accordion-group drop-shadow-butterfly">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" href="#resume">
						<h4>Resume</h4>
					</a>
				</div>
				<div id="resume" class="accordion-body collapse">
					<div class="accordion-inner">
						{{ Form::open_for_files('applicant/account', 'POST', array('id' => 'applicant-resume', 'class' => 'applicant-account-form  validate-form form ')); }}
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

							<button id="add-resume" class="btn pull-right add" type="button"><i class="icon-plus icon-white"></i> Resume</button>
							<input type="file" id="resume-file" name="resume-file"/>
							{{ Form::close(); }}
						</div>
					</div>
				</div>


				<div class="accordion-group drop-shadow-butterfly">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" href="#coverletter">
							<h4>Coverletters</h4>
						</a>
					</div>
					<div id="coverletter" class="accordion-body collapse">
						<div class="accordion-inner">
							{{ Form::open_for_files('applicant/account', 'POST', array('id' => 'applicant-coverletter', 'class' => 'applicant-account-form  validate-form form ')); }}
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


	<!--MODAL -->

	{{ Form::open('applicant/qualification', 'POST', array('id' => 'applicant-qualifications', 'class' => 'applicant-account-form  validate-form')); }}
	<div id='qualification-form' class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Qualification Details</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<ol class="qualifications-field-child">
					<li>
						<label for="qualification-level">Level</label>
						<select id="qualification-level" name="qualification-level" class="input-large validate[required]" data-prompt-position="centerLeft">
							<option value="Graduate">Graduate</option>
							<option value="Post Graduate">Post Graduate</option>
							<option value="PHD">PHD</option>
						</select>
					</li>
					<li>
						<label for="qualification-title">Program Title</label>
						<input id="qualification-title" type="text" name="qualification-title" placeholder="e.g. Bachelor of Science" class="input-large validate[required]" data-prompt-position="centerLeft">
					</li>
					<li>
						<label for="qualification-school">Institude</label>
						<input id="qualification-school" type="text" name="qualification-school" class="input-large validate[required]" data-prompt-position="centerLeft">
					</li>
					<li>
						<label for="qualification-field-of-study">Field of Study</label>
						<input id="qualification-field-of-study" type="text" name="qualification-field-of-study" placeholder="e.g. Biomedical Science Major" class="input-large validate[required]" data-prompt-position="centerLeft">
					</li>
					<li>
						<label for="qualification-achievement">Achievements</label>
						<textarea id="qualification-achievement" name="qualification-achievement" class="input-large"></textarea>
					</li>
					<li>
						<label for="qualification-started">Year Attended</label>
						<select name="qualification-started" id="qualification-started" class="input-large validate[required]" data-prompt-position="centerLeft">
							@for($i = (int)date('Y'); $i >= 1950; $i-- )
							<option value="{{$i}}">{{$i}}</option>
							@endfor
						</select>

					</li>
					<li>
						<label for="qualification-ended">Year Ended <small>(or expected graduated year)</small></label>
						<select name="qualification-ended" id="qualification-ended" class="input-large validate[required]">
							@for($i = (int)date('Y'); $i >= 1950; $i-- )
							<option value="{{$i}}">{{$i}}</option>
							@endfor
						</select>
					</li>
				</ol>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="btn btn-primary" type="submit" id="btn-qualification-save">Save changes</button>
			<input type="hidden" value="" id="qualification-id" />
		</div>
	</div>
	<input type="hidden" name="form-type" value="qualification">
	{{ Form::close(); }}


	{{ Form::open('applicant/experience', 'POST', array('id' => 'applicant-experience', 'class' => 'applicant-account-form  validate-form ')); }}
	<div id='employment-form' class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Employment Details</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<ol class="employment-field-child">
					<li>
						<label for="employment-name">Company Name</label>
						<input id="employment-name" type="text" name="employment-name" class="input-large validate[required]" data-prompt-position="centerLeft">

					</li>
					<li>
						<label for="employment-industry">Industry</label>
						<input id="employment-industry" type="text" name="employment-industry" class="input-large validate[required]" data-prompt-position="centerLeft">
					</li>
					<li>
						<label for="employment-position">Position</label>
						<input id="employment-position" type="text" name="employment-position" class="input-large validate[required]" data-prompt-position="centerLeft">
					</li>
					<li>
						<label for="employment-started-month">From</label>
						<select name="employment-started-month" id="employment-started-month" class="input-small validate[required]" data-prompt-position="centerLeft">
							<option value="January">January</option>
							<option value="February">February</option>
							<option value="March">March</option>
							<option value="April">April</option>
							<option value="May">May</option>
							<option value="June">June</option>
							<option value="July">July</option>
							<option value="August">August</option>
							<option value="September">September</option>
							<option value="October">October</option>
							<option value="November">November</option>
							<option value="December">December</option>
						</select>
						<select name="employment-started-year" id="employment-started-year" class="input-small validate[required]" data-prompt-position="centerLeft">
							@for($i = (int)date('Y'); $i >= 1950; $i-- )
							<option value="{{$i}}">{{$i}}</option>
							@endfor
						</select>
					</li>
					<li>
						<label for="employment-ended-month">To</label>
						<select name="employment-ended-month" id="employment-ended-month" class="input-small validate[required]" data-prompt-position="centerLeft">
							<option value="January">January</option>
							<option value="February">February</option>
							<option value="March">March</option>
							<option value="April">April</option>
							<option value="May">May</option>
							<option value="June">June</option>
							<option value="July">July</option>
							<option value="August">August</option>
							<option value="September">September</option>
							<option value="October">October</option>
							<option value="November">November</option>
							<option value="December">December</option>
						</select>
						<select name="employment-ended-year" id="employment-ended-year" class="input-small validate[required]" data-prompt-position="centerLeft">
							<option value="1">Current Work here</option>
							@for($i = (int)date('Y'); $i >= 1950; $i-- )
							<option value="{{$i}}">{{$i}}</option>
							@endfor
						</select>

					</li>
					<li>
						<label for="employment-scope">Job Scope</label>
						<textarea id="employment-scope" name="employment-scope" class="input-large validate[required]" data-prompt-position="centerLeft"></textarea>
					</li>
				</ol>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="btn btn-primary" type="submit" id="btn-employment-save">Save changes</button>
			<input type="hidden" value="" id="employment-id" />
		</div>
	</div>
	<input type="hidden" name="form-type" value="employment">
	{{ Form::close(); }}


	{{ Form::open('applicant/expertise', 'POST', array('id' => 'applicant-expertise', 'class' => 'applicant-account-form  validate-form ')); }}
	<div id='expertise-form' class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Edit Expertise</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<ol class="expertise-field-child">
					<li>
						<label for="expertise">Expertise</label>
						<input id="expertise-value" type="text" name="expertise-value" class="input-large validate[required]" data-prompt-position="centerLeft">
					</li>
				</ol>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="btn btn-primary" type="submit" id="btn-expertise-save">Save changes</button>
			<input type="hidden" value="" id="prev-expertise-value" name="prev-expertise-value" />
		</div>
	</div>
	{{ Form::close(); }}
	@endsection