@layout('layout.level2')

@section('custom_styles')
@if(isset($job->template)) 
	<style>
	{{ $job->template->css }}
	</style>
	@endif
@endsection

@section('content')

<div class="row">
	<section class="notice-container span8 white-bg drop-shadow-black">
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
		
	<aside class="span4" id="side-info">

		<div class="white-bg drop-shadow-black">
			<h3 class="container-header">Summary</h3>
			<dl class="data-list">
				<dt>Location</dt>
				<dd>{{$job->location->name}}, {{$job->sub_location->name}}</dd>
				<dt>Salary</dt>
				<dd>{{ $job->salary_range }}</dd>
				<dt>Work type</dt>
				<dd>Contract</dd>
				<dt>Posted on</dt>
				<dd>{{Formatter::format_date($job->created_at, Formatter::DATE_LONG);}}
				</dd>
			</dl>
			<div class="controls">

				@if($is_applied)
				<a href="javascript:void(0);" class='btn'>You have applied for this job</a>
				@else
					@if ($job->apply )
					<div class="alert alert-info">
						This employer has used a custom application form. Please ensure that you have popup enabled in order to view. Alternatively, please hold down <strong>Ctrl</strong> (Windows) or <strong>Command</strong> (Mac) and click on "Apply Now". 
					</div>
					
					<a id="btn-apply" href="{{$job->apply}}" class="btn btn-primary btn-large" rel="popup">Apply for this job</a>
					@else 
					<a id="btn-apply" href="/job/apply/{{$job->id}}" class="btn btn-primary btn-large">Apply for this job</a>
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
					<a href="#">Share it on facebook</a>
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
@if($is_applicant)
<!-- Modal Create Group -->
<div id="create-group" class="modal hide fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<h3 id="myModalLabel">Manage Tags</h3>
	</div>
	<div class="modal-body">
		<div class="tagHandler">
			<ul id="ajaxget_tag_handler" class="tagHandlerContainer">
				<li class="tagInput">
					<input class="tagInputField ui-autocomplete-input" type="text" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
				</li>
			</ul>	
		</div>
		<small>Click on the textbox <strong>start</strong>. Hit enter to <strong>insert</strong> tag. Click on the tag to <strong>remove</strong>.</small>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true" data-controls-modal="create-group" onclick="location.reload();">Close</button>
	</div>
</div>
@endif
@endsection