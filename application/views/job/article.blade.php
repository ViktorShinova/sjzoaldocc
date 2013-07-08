@layout('layout.level2')

@section('custom_styles')

@if(isset($job1->template)) 
<?php $data = unserialize($job1->template->data);  ?>
<style>
	{{ $job1->template->css }}
</style>
@endif
@endsection

@section('content')
<div class="row">


	<section class="notice-container span8 white-bg drop-shadow-black">
		<header class="notice-header">
			
			@if( isset($data['header-image']) && $data['title-type'] == 'image' ) 
			<img src="{{$data['header-image']}}" />
			@else
			<h1>{{ $job1->title }}</h1>
			@endif
			
		</header>
		<article class="notice-body">
			{{ $job1->description }}
		</article>
		<footer class="notice-footer">
			<p>{{ $job1->contact }}</p>
		</footer>
	</section>

	<aside class="span4" id="side-info">

		<div class="white-bg drop-shadow-black summary">
			<h3 class="container-header">Summary</h3>
			<p>{{Formatter::format_date($job1->created_at, Formatter::DATE_LONG);}}</p>
			<ul class="data-list">
				<li><label>Location:</label><span>{{$job1->location->name}}, {{$job1->sub_location->name}}</span></li>
				<li><label>Salary:</label><span>{{ $job1->salary_range }}</span></li>
				<li><label>Work type:</label><span>{{ Formatter::format_worktype($job1->work_type) }}</span></li>
			</ul>
			<div class="controls">

				@if($is_applied)
				<a href="javascript:void(0);" class='btn'>You have applied for this job</a>
				@else
				@if ($job1->apply )
				<div class="alert alert-info">
					This employer has used a custom application form. Please ensure that you have popup enabled in order to view. Alternatively, please hold down <strong>Ctrl</strong> (Windows) or <strong>Command</strong> (Mac) and click on "Apply Now". 
				</div>

				<a id="btn-apply" href="{{$job1->apply}}" class="btn btn-warning btn-large" rel="popup">Apply Now</a>
				@else 
				<a id="btn-apply" href="/job/apply/{{$job1->slug}}" class="btn btn-warning btn-large">Apply Now</a>
				@endif
				@endif

			</div>
		</div>

		<div id="side-feature">
			<ul id="feature-listing">
				<li>
					@if($is_applicant)
					@if ( in_array ($job1->id, $applicant_shortlists )  )
					<a data-job-id="{{$job1->id}}" href="#" class="shortlist-btn active apply"><i class="icon-bookmark"></i> Shortlisted</a>
					@else 
					<a data-job-id="{{$job1->id}}" href="#" class="shortlist-btn apply"><i class="icon-bookmark"></i> Shortlist it!</a>
					@endif
					@else
					<a data-target="#login-modal" role="button" href="#" data-toggle="modal"><i class="icon-bookmark"></i>Shortlist it!</a>
					@endif
					
				</li>
				<li>
					<a href="/job/mail/{{$job1->id}}" rel="popup"><i class="icon-envelope"></i>Email this job</a>
				</li>
				<li>
					<a href="#"><i class="icon-print"></i>Print this job</a>
				</li>
				<li>
					<a href="#"><i class="icon-facebook-sign"></i>Share it on Facebook</a>
				</li>
				<li>
					<a href="#"><i class="icon-twitter"></i>Share it on Twitter</a>
				</li>
				<li>
					<a href="/applicant/shortlists"><i class="icon-star"></i>View my shortlists</a>
				</li>
			</ul>
		</div>


		@if (!empty($related_jobs))
		<div class="white-bg drop-shadow-black">
			<h3 class="container-header">Other related jobs</h3>
			<ul id="related-jobs">
				@foreach($related_jobs as $_job)
				<li>
					<strong><a href="/job/article/{{$_job->id}}">{{$_job->title}}</a></strong>
					<p>
						{{$_job->location_name}} | {{$_job->company}}
					</p>
				</li>
				@endforeach
			</ul>
		</div>
		@endif
	</aside>
</div>

<div id="login-modal" class="modal hide fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="create-group-label" aria-hidden="true">
	<div class="modal-header">

		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Please Login to Shortlist</h3>
	</div>
	@if ( $is_employer ) 
	<div class="modal-body">

		You are currently logged in as an employer. The shortlist function is only to available to applicants.

	</div>
	@else 
	<form  class="modal-body form-horizontal  validate-form form " action="/login" method="post">
		<div class="control-group">
			<label class="control-label" for="username">Email</label>
			<div class="controls">
				<input class="validate[required]" type="text" id="username" placeholder="Email" name="username">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password</label>
			<div class="controls">
				<input  class="validate[required]" type="password" id="password" placeholder="Password"  name="password">
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-warning">Sign in</button>
			</div>
		</div>
	</form>
	@endif

	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>



</div>
@endsection