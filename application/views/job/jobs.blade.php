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
<div class='form-inline pull-right' id='sort-toolbar'>
	<label>Sort By </label>
	{{Form::select( 'sort', array('score'=>'Most Relevant', 'date-desc' => 'Latest','date-asc'=>'Oldest','title'=>'Title','today'=>'Show today\'s post'), $sort_order ,array('onchange'=>'this.form.submit()'))}}
</div>

<ul class="listings" id="job-listing">

	@foreach($jobs->results as $job)
	<li class="white-bg drop-shadow-butterfly">
		@if( $is_applicant )

		@if ( in_array ($job->id, $applicant_shortlists )  )
		<span class="shortlist-tag active"><i class="icon-star"></i><i class="arrow"></i></span>
		@else 
		<span class="shortlist-tag"><i class="icon-star"></i><i class="arrow"></i></span>
		@endif



		@endif

		<div class="job-wrapper">
			<!--figure-->

			<article class="main-info">
				@if($job->logo)
				<figure class="figure">
					<img src="{{$job->logo}}">
				</figure>

				@endif
				<h2><a href="/job/article/{{$job->id}}"><?php //echo preg_replace($tokens, $replacePattern, $job->title)  ?>{{$job->title}}</a></h2>
				<p><a href="/job/search?job-category={{$job->category_id}}">{{ $job->category_name }}</a></p>
				<p>
					{{$job->summary}}
				</p>
			</article>

			<aside class="additional-info">
				<h4 class="company">{{ $job->company }}</h4>
				<span class="location">{{ $job->location_name }}, {{ $job->sub_location_name }}</span>
				<span class="salary">{{ $job->salary_range }}</span>
				<span class="date">
					{{	Formatter::format_date($job->created_at, Formatter::DATE_SHORT); }}
				</span>
			</aside>
		</div>
		<div id="job-controls" class="pull-right">
			<a href="/job/article/{{$job->id}}" class="btn btn-primary"><i class="icon-eye-open"></i> View</a>
			@if($is_applicant)

				@if ( in_array ($job->id, $applicant_shortlists )  )
				<button data-job-id="{{$job->id}}" class="btn shortlist-btn active"><i class="icon-star"></i> Shortlist</button>
				@else
				<button data-job-id="{{$job->id}}" class="btn shortlist-btn "><i class="icon-star"></i> Shortlist</button>
				@endif


			@else
			<a class="btn" data-target="#login-modal" role="button" href="#" data-toggle="modal"><i class="icon-star"></i> Shortlist</a>
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
@section('page-scripts')

setTimeout( function() {

$("#job-sub-category option").removeAttr('selected');
$("#job-sub-category option").eq({{$selected_sub_category}}).attr('selected', 'selected');

$("#job-sub-location option").removeAttr('selected');
$("#job-sub-location option").eq({{$selected_sub_location}}).attr('selected', 'selected');
}, 500);

@endsection