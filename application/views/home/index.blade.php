@layout('layout.home')

@section('content')


<div class="row">
<section id="job-search" class="span12 white-bg drop-shadow-black">

	<h2 class="container-header">Start searching now!<a id="emp-reg" href="/employer/register"><i class="icon-hand-right"></i></a></h2>

	<form class="row form-horizontal" method="get" action="/job/search">
		<div class="span6">

			<div class="control-group">
				<label class="control-label" for="job-keywords">Keywords</label>
				<div class="controls">
					<input type="text" placeholder="" class="input-xlarge" name="keywords" id="job-keywords">
				</div>
			</div>
			<div class="control-group">

				<label for="job-category" class="control-label">Industry</label>
				<div class="controls">

					{{ Form::select('job-category', $categories, array(), array('class' => 'input-xlarge', 'id' =>'job-category')); }}

				</div>
			</div>
			<div class="control-group">
				<label for="job-sub-category" class="control-label">Position</label>
				<div class="controls">

					{{ Form::select('job-sub-category', $categories, array(), array('class' => 'input-xlarge', 'id' =>'job-sub-category')); }}

				</div>
			</div>
			<div class="control-group"> 
				<label class="control-label">Salary Range <br/>(Annual Rate)</label>
				<div class="controls">

					<div class="input-prepend">
						<span class="add-on">$</span>
						<select class="span1" id="min-salary" name="min-salary">
							<option value='0'>0</option>
							<option value='30000'>30k</option>
							<option value='40000'>40k</option>
							<option value='50000'>50k</option>
							<option value='60000'>60k</option>
							<option value='70000'>70k</option>
							<option value='80000'>80k</option>
							<option value='90000'>90k</option>
							<option value='100000'>100k</option>
							<option value='110000'>110k</option>
							<option value='120000'>120k</option>
							<option value='130000'>130k</option>
							<option value='140000'>140k</option>
							<option value='150000'>150k</option>
						</select>
					</div>
					<div class="input-prepend">
						<span class="add-on">$</span>
						<select class="span1" id="max-salary" name="max-salary">
							<option value='40000'>40k</option>
							<option value='50000'>50k</option>
							<option value='60000'>60k</option>
							<option value='70000'>70k</option>
							<option value='80000'>80k</option>
							<option value='90000'>90k</option>
							<option value='100000'>100k</option>
							<option value='110000'>110k</option>
							<option value='120000'>120k</option>
							<option value='130000'>130k</option>
							<option value='140000'>140k</option>
							<option value='150000'>150k</option>
							<option value='160000'>160k</option>
							<option value='170000'>170k</option>
							<option value='180000'>180k</option>
							<option value='190000'>190k</option>
							<option value='200000' selected='selected'>200k+</option>
						</select>
					</div><br/>
					<label class="checkbox" id="pay-hourly">
				    	<input type="checkbox" name='payment-type' value="hour" /> Pay hourly
				    </label>
				    <label class="checkbox" id="pay-annually">
				    	<input type="checkbox" name='payment-type' value="annually" /> Pay annually
				    </label>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label for="job-location" class="control-label">Location</label>
				<div class="controls">
					{{ Form::select('job-location', $locations, array(), array('class' => 'input-xlarge', 'id'=>'job-location')); }}
				</div>
			</div>
			<div class="control-group">
				<label for="job-sub-location" class="control-label">Refined Location</label>
				<div class="controls">
					{{ Form::select('job-sub-location', $locations, array(), array('class' => 'input-xlarge', 'id'=>'job-sub-location')); }}
				</div>
			</div>
			<div class="control-group">
				<label for="work-type" class="control-label">Work Type</label>
				<div class="controls">
					{{ Form::select('work-type[]', $work_types, array(), array('class' => 'input-xlarge', 'multiple' => 'multiple', 'id'=>'work-type')); }}
				</div>

			</div>
		</div>
		<button type="submit" id="search" class="btn btn-primary">Search</button>
	</form>
</section>
</div>

<!--    <ul id="feature-jobs">
		   
        @foreach ($jobs as $job) 
            <li>
                <div class="job">

                    <header role="job-category" class="red-code-bg">
                        <span>{{ $job->category_name }}</span>
                    </header>
                    <div class="red-code-arrow arrow-down"></div>

                    <h3>{{ $job->title }}</h3>

                    <div class="description">
                        <img src="http://quickimage.it/180x50">

                        <p>
                            {{ $job->summary }}
                        </p>

                        <span class="location">{{ $job->location_name }}</span>
                        <span class="salary">{{ $job->salary_range }}</span>
						
                    </div>

                    <footer>
                            <a href="/job/article/{{ $job->id }}" class="btn btn-primary">View</a>
                            <div class="btn-group">
                                <button class="btn"><i class="icon-star"></i> Shortlist</button>
                                <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">High salary</a></li>
                                    <li><a href="#">Close to home</a></li>
                                    <li><a href="#">Will consider</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-th-large"></i> Create new group</a></li>
                                </ul>
                            </div>          
                    </footer>
                </div>
            </li>

        @endforeach                                                                                                                 
    </ul>-->

@endsection
