@layout('layout.level2')

@section('content')

<h2>My Shortlist</h2>
<div class="row">
	<div class="span9">
		<ul class="listings" id="job-listing">

			@foreach($shortlists->results as $shorlist)
			<li class="white-bg drop-shadow-butterfly">

				<div class="job-wrapper">
					<!--figure-->

					<article class="main-info">
						@if($shorlist->logo)
						<figure class="figure">
							<img src="{{$shorlist->logo}}">
						</figure>

						@endif
						<h2><a href="/job/article/{{$shorlist->slug}}">{{$shorlist->title}}</a></h2>
						<p><a title="Find more from this category." class="category" href="/job/search?job-category={{ $shorlist->category_id}}">{{ $shorlist->category_name }}</a></p>
						<p>
							{{ $shorlist->summary}}
						</p>
					</article>

					<aside class="additional-info">
						<h4 class="company"><a href="/job/search?employer-id={{ $shorlist->employer_id}}" title="Find more from the same employer.">{{ $shorlist->company }}</a></h4>
						<span class="location">{{ $shorlist->location_name }}, {{ $shorlist->sub_location_name }}</span>
						<span class="salary">{{ $shorlist->salary_range }}</span>
						<span class="date">
							{{	Formatter::format_date( $shorlist->created_at, Formatter::DATE_LONG_W_TIME); }}
						</span>
					</aside>
				</div>
				<div id="job-controls" class="pull-right">
					<a href="/job/article/{{$shorlist->slug}}" class="btn btn-warning">View<i class="icon-chevron-sign-right"></i></a>
				</div>
				<div class="clearfix"></div>
			</li>
			@endforeach

			<?php echo $shortlists->links(); ?>                                  
			<!-- #pagination -->

		</ul>
	</div>
	<aside class="span3 hidden-phone hidden-tablet">
		<div class="white-bg drop-shadow-black">
			<h3 class="container-header">My Account</h3>
			<ul id="related-jobs">
				
				<li>
					<strong>Latest Job</strong>
					<p>
						test
					</p>
				</li>
				
			</ul>
		</div>
		
		
		<div id="side-feature"  data-spy="affix" data-offset-top="575" data-offset-bottom="403">
			<ul id="feature-listing">
				<li>
					<a href="/pages/how_to_resume/">How to write a resume.</a>
				</li>
				<li>
					<a href="/pages/how_to_coverletter/">How to write a cover letter.</a>
				</li>
				<li>
					<a href="/pages/employers_expectations/">What are employers looking for?</a>
				</li>
				<li>
					<a href="/pages/prepare_for_interview/">Preparing for an interview</a>
				</li>
			</ul>
		</div>
	</aside>
</div>
<!-- #listings -->


@endsection