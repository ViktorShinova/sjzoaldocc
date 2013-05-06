@layout('layout.level2')

@section('content')

<div class="row">
	@if ( $errors->all(':message') )
	<div class="validation error">
		@foreach($errors->all(':message') as $message)
		<p>{{ $message }}</p>
		@endforeach
	</div>
	@endif

	@if ( $notfound )
	<div class="span6 offset3 text-center">
		<h1>User not found :(</h1>
		<p class="lead">The person you are looking for cannot be found. Please check the spelling and try again.</p>
	</div>
	@elseif( !$user->viewable  && (Auth::user()->id != $user->user_id) )
		<div class="span6 offset3 text-center">
			<h1>User profile is set to private</h1>
			<p class="lead">Sorry, the user profile is not viewable.</p>
		</div>
	@else
	<div class="span8 offset2 white-bg drop-shadow box-form-layout">
		<div class="media">
			<img class="media-object pull-left thumbnail" style="height:120px;" src="{{ $user->profilepic }}">
			<div class="media-body">
				<h3 class="media-heading">{{ $user->first_name }} {{ strtoupper($user->last_name) }}</h3>
				<span class="muted">{{ $user->preferred_location }} | {{ $user->preferred_job }}</span>
				<blockquote>
					<p>{{ $user->summary }}</p>
				</blockquote>
			</div>
		</div>

		<hr/>

		@if( count($qualifications) > 0 && !$privacy_settings['qualifications_is_private'] )
		<h4 class="text-center"><i class="icon-book"></i> Qualifications</h4>

			@foreach($qualifications as $qualification)
			<dl class="dl-horizontal">
				<dt>Program Title</dt>
				<dd><strong>{{ $qualification->name }}</strong></dd>
				<dd class="muted">{{ $qualification->started }} - {{ $qualification->ended }}</dd>

				@if( $qualification->school != "" )
				<dt>School</dt>
				<dd>{{ $qualification->school }}</dd>
				@endif

				@if( $qualification->field_of_study != "" )
				<dt>Field of Study</dt>
				<dd>{{ $qualification->field_of_study }}</dd>
				@endif

				@if( $qualification->description != "" )
				<dt>Description</dt>
				<dd>{{ $qualification->description }}</dd>
				@endif
			</dl>
			@endforeach
		<hr/>
		@endif

		@if( count($workhistories) > 0 && !$privacy_settings['employer_history_is_private'] )
		<h4 class="text-center"><i class="icon-suitcase"></i> Employment History </h4>

			@foreach($workhistories as $workhistory)
			<dl class="dl-horizontal">
				<dt>Employer's Name</dt>
				<dd><strong>{{ $workhistory->employer_name }}</strong></dd>
				<?php
					$workhistory_ended = ($workhistory->currently_work_here == 1) ? 'Current' : Formatter::format_date($workhistory->ended, Formatter::DATE_MONTH_YEAR);
				?>
				<dd class="muted">{{ Formatter::format_date($workhistory->started, Formatter::DATE_MONTH_YEAR) }} - {{ $workhistory_ended }}</dd>

				<dt>Industry</dt>
				<?php $workhistory_industry = Category::find($workhistory->industry)->name; ?>
				<dd>{{ $workhistory_industry  }}</dd>

				<dt>Description</dt>
				<dd>{{ $workhistory->description  }}</dd>
			</dl>
			@endforeach
		<hr/>
		@endif

		@if( !$privacy_settings['expertise_is_private'] )
		<h4 class="text-center"><i class="icon-certificate"></i> Expertise </h4>
		<div id="expertise">
			@foreach($user->skills as $skill)
				<span>{{ $skill }}</span>
			@endforeach
		</div>
		@endif

		@if( !$privacy_settings['resume_is_private'] )
		<hr/>
		<h4 class="text-center"><i class="icon-file-alt"></i> Resume </h4>
		
		<ul class="listing" id="document-listing">
			@foreach ($resumes as $resume)
			<li class="item">
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
		@endif

		@if( !$privacy_settings['coverletters_is_private'] )
		<hr/>
		<h4 class="text-center"><i class="icon-envelope"></i> Coverletters </h4>

		<ul class="listing" id="document-listing">
			@foreach ($coverletters as $coverletter)
			<li class="item">
				<a href="{{ $coverletter->path }}" target="_blank">
					<span class="icon {{ $coverletter->type }}"></span>
				</a>
				<span class="title"><a href="{{ $coverletter->path }}" target="_blank">{{ $coverletter->coverletter }}</a></span>
				<span class="filesize">{{ $coverletter->filesize }}</span>
				<span class="date-upload">{{ $coverletter->created_at }}</span>
			</li>
			@endforeach
		</ul>
		@endif
	</div>
		<!--aside class="span4" id="side-info">
			<div class="white-bg drop-shadow">
				<h3 class="container-header">People Also Viewed</h3>
				<ul id="related-jobs">
				</ul>
			</div>
			<img src="http://placehold.it/370x150/ff4d62">
		</aside-->
	@endif
</div>
<!-- /.row -->
	
@endsection