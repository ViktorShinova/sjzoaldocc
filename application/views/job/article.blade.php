@layout('layout.level2')

@section('custom_styles')
@if(isset($job1->template)) 
<style>
	{{ $job1->template->css }}
</style>
@endif
@endsection

@section('content')
<div class="row">


	<section class="notice-container span8 white-bg drop-shadow-black">
		<header class="notice-header">
			<h1>{{ $job1->title }}</h1>
		</header>
		<article class="notice-body">
			{{ $job1->description }}
		</article>
		<footer class="notice-footer">
			{{ $job1->contact }}
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

				<a id="btn-apply" href="{{$job1->apply}}" class="btn btn-primary btn-large" rel="popup">Apply for this job</a>
				@else 
				<a id="btn-apply" href="/job/apply/{{$job1->id}}" class="btn btn-primary btn-large">Apply for this job</a>
				@endif
				@endif

			</div>
		</div>

		<div id="side-feature">
			<ul id="feature-listing">
				<li>
					@if($is_applicant)				
					<a href="#"><i class="icon-star"></i>Shortlist it!</a>
					@else 
					<a href="#"><i class="icon-star"></i>Shortlist it!</a>
					@endif
				</li>
				<li>
					<a href="#"><i class="icon-envelope"></i>Email this job</a>
				</li>
				<li>
					<a href="#"><i class="icon-print"></i>Print this job</a>
				</li>
				<li>
					<a href="#">Share it on Facebook</a>
				</li>
				<li>
					<a href="#">Share it on Twitter</a>
				</li>
				<li>
					<a href="/applicant/shortlists">View all shortlist</a>
				</li>
			</ul>
		</div>


		@if (!empty($jobs))
		<div class="white-bg drop-shadow-black">
			<h3 class="container-header">Other related jobs</h3>
			<ul id="related-jobs">
				@foreach($jobs as $_job)
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
@endsection