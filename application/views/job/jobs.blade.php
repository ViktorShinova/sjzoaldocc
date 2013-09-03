@layout('layout.lvl2-side')

@section('content')

<?php
//$tokens = explode(' ', preg_replace('/\s\s+/', ' ', trim($keywords)));
// var_dump($tokens);
//for ($i = 0; $i < count($tokens); $i++) {
//
//	$tokens[$i] = "/\b" . trim($tokens[$i]) . "\b/i";
//}
//$replacePattern = "<strong>$0</strong>";
?>
@if(count($jobs->results) == 0 ) 

<p><strong>Your search yield no results. Please enter a different set of keyword(s).</strong></p>

@endif
<div class='form-inline pull-left' id='sort-toolbar'>
	@if( $applicant && $applicant->job_mail ) 
	<div id="confirm-modal" class="modal hide fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="create-group-label" aria-hidden="true">
		<div class="modal-header">

			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Are you sure?</h3>
		</div>
		<div class="modal-body">
			You already have an existing career mail settings. By clicking ok, your previous settings will be overwritten.
		</div>
		<div class="modal-footer">
			<a href="/applicant/careermail?{{$_SERVER['QUERY_STRING']}}" class="btn btn-primary" aria-hidden="true">Ok</a>
			<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>

	</div>
	<a class="btn" data-target="#confirm-modal" data-toggle="modal" >Email me similar jobs!</a>
	@elseif( $applicant )
	<a class="btn" href="/applicant/careermail?{{$_SERVER['QUERY_STRING']}}">Email me similar jobs!</a>
	@else
	<a class="btn" data-target="#login-modal" role="button" href="#" data-toggle="modal">Email me similar jobs!</a>
	@endif

</div>
<div class='form-inline pull-right' id='sort-toolbar'>
	<label>Sort By&nbsp;&nbsp;&nbsp;&nbsp;</label>
	{{Form::select( 'sort', array('score'=>'Most Relevant', 'date-desc' => 'Latest','date-asc'=>'Oldest','title'=>'Title','today'=>'Show today\'s post'), $sort_order ,array('onchange'=>'this.form.submit()'))}}
</div>

<ul class="listings" id="job-listing">

	@foreach($jobs->results as $job)
	<li class="white-bg tile">
		@if( $is_applicant )
			@if ( in_array ($job->id, $applicant_shortlists )  )
			<span class="shortlist-tag active"></span>
			@else 
			<span class="shortlist-tag"></span>
			@endif
		@endif

		<div class="job-wrapper">
			<!--figure-->

			<article class="main-info">
				<h2><a href="/job/article/{{$job->slug}}"><?php //echo preg_replace($tokens, $replacePattern, $job->title)   ?>{{$job->title}}</a></h2>
							
				<a title="Find more from this category." class="category" href="/job/search?job-category={{$job->category_id}}">{{ $job->category_name }}</a>
				<p>
					{{$job->summary}}
				</p>
			</article>

			<aside class="additional-info">
				@if($job->logo)
					
					<img src="{{$job->logo}}">
				
				@endif
				<h4 class="company"><a href="/job/search?employer-id={{$job->employer_id}}" title="Find more from the same employer.">{{ $job->company }}</a></h4>
				<span class="location"><i class="icon-map-marker"></i> {{ $job->location_name }}, {{ $job->sub_location_name }}</span>
				<span class="salary"><i class="icon-info"></i>{{ $job->salary_range }}</span>
				<span class="date"><i class="icon-calendar"></i>{{ date('d F Y', strtotime($job->created_at)) }} {{ date('g:ia', strtotime($job->created_at)) }}</span>	
			</aside>
		</div>
		<div id="job-controls" class="pull-right">
			<a href="/job/article/{{$job->slug}}" class="">More<i class="icon-chevron-right"></i></a>
			@if($is_applicant)

			@if ( in_array ($job->id, $applicant_shortlists )  )
			<a data-job-id="{{$job->id}}" class="shortlist-btn active">Shortlisted<i class="icon-bookmark"></i></a>
			@else
			<a data-job-id="{{$job->id}}" class="shortlist-btn ">Shortlist<i class="icon-bookmark"></i></a>
			@endif


			@else
			<a id="popover" data-target="#login-modal" role="button" href="#" data-toggle="modal">Shortlist<i class="icon-bookmark"></i></a>
			@endif
		</div>
		<div class="clearfix"></div>
	</li>
	@endforeach

	<?php echo $jobs->appends(array('keywords' => Input::get('keywords'), 'work-type' => Input::get('work-type'), 'location' => Input::get('location'), 'job-category' => Input::get('job-category')))->links(); ?>                                  
	<!-- #pagination -->

</ul>
<!-- #listings -->


@endsection
