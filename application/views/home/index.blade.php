@layout('layout.home')

@section('content')


<div class="row">
	<section id="job-search" class="span12">

		<form class="row form-horizontal" method="get" action="/job/search">
			<div class="span6">

				<div class="control-group">
					<label class="control-label" for="job-keywords">Keywords:</label>
					<div class="controls">
						<input type="text" placeholder="" class="input-xlarge" name="keywords" id="job-keywords">
					</div>
				</div>
				<div class="control-group">

					<label for="job-category" class="control-label">Industry:</label>
					<div class="controls">

						{{ Form::select('job-category', $categories, array(), array('class' => 'input-xlarge', 'id' =>'job-category')); }}

					</div>
				</div>
				<div class="control-group">
					<label for="job-sub-category" class="control-label">Position:</label>
					<div class="controls">

						{{ Form::select('job-sub-category', $categories, array(), array('class' => 'input-xlarge', 'id' =>'job-sub-category')); }}

					</div>
				</div>
				<div class="control-group"> 
					<label class="control-label">Salary Range:</label>
					<div class="controls">

						<div class="input-prepend">
							<span class="add-on">$</span>
							<select class="span1" id="min-salary" name="min-salary">
								<option value='0'>0</option>
								@for( $i = 30; $i <= 200; $i = $i+ 10 )
								<option value='{{$i*1000}}'>{{$i}}k</option>
								@endfor
							</select>	
						</div>
						<div class="input-prepend">
							<span class="add-on">$</span>
							<select class="span1" id="max-salary" name="max-salary">
								<option value='40000'>40k</option>
								@for( $i = 40; $i <= 200; $i = $i+ 10 )
								<option value='{{$i*1000}}'>{{$i}}k</option>
								@endfor
							</select>
						</div>
						<select class="span1" id="salary-type" name="salary-type">
							<option value='annually'>Annually</option>
							<option value='hourly'>Hourly</option>
						</select>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="control-group">
					<label for="job-location" class="control-label">Location:</label>
					<div class="controls">
						{{ Form::select('job-location', $locations, array(), array('class' => 'input-xlarge', 'id'=>'job-location')); }}
					</div>
				</div>
				<div class="control-group">
					<label for="job-sub-location" class="control-label">Refined Location:</label>
					<div class="controls">
						{{ Form::select('job-sub-location', $locations, array(), array('class' => 'input-xlarge', 'id'=>'job-sub-location')); }}
					</div>
				</div>
				<div class="control-group">
					<label for="work-type" class="control-label">Work Type:</label>
					<div class="controls">
						{{ Form::select('work-type[]', $work_types, array(), array('class' => 'input-xlarge', 'multiple' => 'multiple', 'id'=>'work-type')); }}
					</div>

				</div>
			</div>
			<button type="submit" id="search" class="btn btn-primary btn-large">Search</button>
		</form>
	</section>
</div>

<div class="container" id="featured-jobs">
	<div class="row">
		<h2 class="span12">Latest Jobs</h2>
		<div class="span12">
			<div class="row">
				<ul>
					<?php $i=0; ?>
					@foreach ($jobs as $job) 
					<li class="span4 alt-{{$i%3}}">
						<figure>
							<img src="{{$job->logo}}" alt="{{$job->company}}" />
						</figure>
						<div class="wrapper">
							<h3><a href="/job/article/{{$job->slug}}">{{ $job->title }}</a></h3>
							<span class="date"><i class="icon-calendar-empty"></i>{{ date('d F Y', strtotime($job->created_at)) }}</span>
							<span class="time"><i class="icon-time"></i>{{ date('g:ia', strtotime($job->created_at)) }}</span>
							<span class="category"><a href="/job/search?job-category={{$job->category_id}}">{{ $job->category_name }}</a></span>
							
							<p>
								{{ $job->summary }}
							</p>
						</div>
					</li>
					
					<?php $i++; ?>
					@endforeach                                                                                                                 
				</ul>
			</div>

		</div>
		

	</div>
</div>


@endsection
