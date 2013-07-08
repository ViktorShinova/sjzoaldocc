@layout('layout.employer')
@section('page-id')page-employer-adverts@endsection
@section('content')

<h2>Job Post Details</h2>
<br/>

@if ( $errors->all(':message') )
<div class="validation error">
	<p>Please correct the following errors</p>
	<ul>
		@foreach($errors->all(':message') as $message)
		<li>{{ $message }}</li>
		@endforeach
	</ul>
</div>
@endif

@if (Session::get('success')) 
<div class="validation success">
	<p>Your post has been successfully updated.</p>
</div>
@elseif(Session::get('error'))
<div class="validation success">
	<p>Hohoho something is wrong .....</p>
</div>
@endif
<form action="/employer/post/edit/{{$job->id}}" method="post" class="employer-form  validate-form form ">

	<div class="white-bg drop-shadow">
		<h4 style="clear: both">Job Details</h4>
		<div class="pad">
			<ul class="post-desc">
				<li> {{ Form::label('title', 'Title'); echo Form::text('title', $job->title, array('class' => 'validate[required]')); }} </li>
				<li> {{ Form::label('summary', 'Summary'); echo Form::textarea('summary', $job->summary, array('class' => 'validate[required] ckeditor-simple')); }} </li>
				<li> {{ Form::label('desc', 'Description'); echo Form::textarea('desc', $job->description, array('class' => 'validate[required] ckeditor')); }} </li>
				<li> {{ Form::label('contact', 'Contact Information'); echo Form::textarea('contact', $job->contact, array('class' => 'validate[required] contact')); }}
					<a href="#" rel="tooltip" data-toggle="tooltip" title="This will appear at the end of the advertisement. Please only include ways of submitting the application or contact information."><i class="icon-question-sign"></i></a></li>
			</ul>
			<ul class="post-info">
				<li> {{ Form::label('more-info', 'More Infomation'); echo Form::text('more-info', $job->more_info, array('class' => 'test')); }} </li>
				<!--<li> {{ Form::label('video', 'Video'); echo Form::text('video', $job->video, array('class' => 'validate[custom[url]]', 'placeholder'=>'http://www.youtube.com/')); }} </li>-->				
				<!--<li> {{ Form::label('contact', 'Contact Details'); echo Form::text('contact', $job->contact, array('class' => 'validate[required]')); }}</li>-->
				<li> {{ Form::label('job-category', 'Job Category'); echo Form::select('job-category', $categories, $job->category_id, array('class' => 'validate[required]')); }}</li>
				<li> {{ Form::label('sub-category', 'Sub Category'); echo Form::select('sub-category', $sub_categories, $job->sub_category_id); }}</li>		
				<li> {{ Form::label('job-location', "Location"); echo Form::select('job-location', $locations, $job->location_id ) ; }}</li>
				<li> {{ Form::label('sub-location', 'Sub Location'); echo Form::select('sub-location',  $sub_locations, $job->sub_location_id ); }}</li>
			</ul>

			<ul class="post-add-info">
				<li> {{ Form::label('work-type', 'Employment type'); echo Form::select('work-type', $workTypes, $job->work_type); }}</li>	
				<li> {{ Form::label('pay-struct', 'Payment Structure'); echo Form::select('pay-struct', array( "weekly" => "Weekly", "fortnightly" => "Fortnightly" , "monthly" => "Monthly" ), $job->payment_structure ); }}</li>

				<li> {{ Form::label('sal-type', 'Salary Type'); echo  Form::select('sal-type', array('annual' => 'Annually Rates', 'hour' => 'Hourly Rates') , array('class' => 'validate[required]', 'id'=>'sal-type')); }}</li>
				<li> {{ Form::label('min-salary', 'Minimum Salary'); echo  Form::text('min-salary', $job->min_salary, array('class' => 'validate[required,custom[money], funcCall[salaryMinCheck]]', 'id'=>'min-salary')); }}</li>
				<li> {{ Form::label('max-salary', 'Maximum Salary'); echo Form::text('max-salary', $job->max_salary, array('class' => 'validate[required,custom[money], funcCall[salaryMaxCheck]]', 'id'=>'max-salary')); }}</li>
				<li> {{ Form::label('salary-range', 'Salary Description'); echo Form::text('salary-range', $job->salary_range) }} <a href="#" rel="tooltip" data-toggle="tooltip" title="You can enter an interesting note for your salary description. E.g (Good $$$ with super). Only a maximum of 70 characters allowed."><i class="icon-question-sign"></i></a></li>

			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="white-bg drop-shadow">
		<h4 style="clear: both">Custom "Apply Now" Button</h4>
		<div class="pad">
			<ul>

				<li>
					<label class="auto">Do you wish to set a custom "Apply" button?</label>
					<label class="radio">
						{{ Form::radio('custom-apply-select', 'Y',  ( !empty($job->apply) ?  true: false ), array('class' => "yes-no-radio", 'id' => 'custom-yes') ) }}
						Yes
					</label>
					<label class="radio">
						{{ Form::radio('custom-apply-select', 'N',   empty($job->apply) ?  true: false , array('class' => "yes-no-radio", 'id' => 'custom-no') ) }}No

					</label>
				</li>

				<li class="hidden" id="apply-row">
					<label class="auto">Please enter the destination address</label>
					{{ Form::text('custom-apply', $job->apply, array('id'=>'custom-apply', 'class' => 'validate[required,custom[url]]', 'placeholder' => 'http://www.example.com')) }}

				</li>

			</ul>
		</div>
	</div>
	<div class="white-bg drop-shadow">
		<h4 style="clear: both">Please select a template</h4>
		<div class="pad">
			<p><em>If no template is selected, the default template will be automatically assigned.</em></p>
			<input type="hidden" id="post-selected-template" value="{{$job->template_id}}" name="post-selected-template" />
			
			<table class="post-templates">
				<tr>
					<th width="20%">Name</th>
					<th>Preview</th>
					<th>Created At</th>
					<th width="10%"></th>
				</tr>
				@foreach ($templates as $template)
				<tr data-id="{{ $template->id }}" class="template-item {{ ($template->id == $job->template_id) ? 'selected': '' }}" data-id="{{ $template->id }}">
					<td>{{ $template->name }}</td>
					<td><a href="/employer/template/preview/{{$template->id}}" rel="popup" class="template-preview">Preview</a></td>
					<td>{{ Formatter::format_date($template->created_at, Formatter::DATE_LONG_W_TIME) }}</td>
					<td class="icon"><i class="icon-check"></i></td>
				</tr>
				@endforeach
				
			</table>
		</div>
	</div>
	{{ Form::submit("Next Step" , array('class' => 'btn btn-warning clearfix')); }} 
</form>




@endsection
