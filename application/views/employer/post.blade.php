@layout('layout.employer')
@section('page-id')page-post@endsection
@section('content')

<h1 class="container-header">Post a new advertisement</h1>
<div class="content">
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
	<form action="/employer/post/create" method="post" class="employer-form validate-form">

		<ul class="post-desc">
			<li> {{ Form::label('title', 'Title'); echo Form::text('title', Input::old('title') , array('class' => 'validate[required]')); }} </li>
			<li> {{ Form::label('summary', 'Summary'); echo Form::textarea('summary', Input::old('summary'), array('class' => 'validate[required]')); }} </li>
			<li> {{ Form::label('desc', 'Description'); echo Form::textarea('desc', Input::old('desc'), array('class' => 'validate[required]', 'maxLength' => '255')); }} </li>
		</ul>
		<ul class="post-info">
			<li> {{ Form::label('more-info', 'More Infomation'); echo Form::text('more-info', Input::old('more-info'), array('class' => 'test')); }} </li>
			<!--<li> {{ Form::label('video', 'Video'); echo Form::text('video', Input::old('video'),  array('class' => 'validate[custom[url]]', 'placeholder'=>'http://www.youtube.com/')); }} </li>-->				
			<li> {{ Form::label('contact', 'Contact Details'); echo Form::text('contact', Input::old('contact'), array('class' => 'validate[required]')); }}</li>
			<li> {{ Form::label('job-category', 'Job Category'); echo Form::select('job-category', $categories, Input::old('job-category'), array('class' => 'validate[required]')); }}</li>
			<li> {{ Form::label('sub-category', 'Sub Category'); echo Form::select('sub-category', array('' => 'Choose a sub category'), Input::old('sub-category'), array('class'=>'validate[required]')); }}</li>		
			<li> {{ Form::label('job-location', "Location"); echo Form::select('job-location', $locations, Input::old('job-location'), array('class'=>'validate[required]')) }}</li>
			<li> {{ Form::label('sub-location', 'Sub Location'); echo Form::select('sub-location',  array('' => 'Choose a sub location'), Input::old('sub-location'), array('class'=>'validate[required]')) }}</li>
		</ul>
		<ul class="post-add-info">
			<li> {{ Form::label('work-type', 'Employment type'); echo Form::select('work-type', $workTypes, Input::old('work-type')); }}</li>	
			<li> {{ Form::label('pay-struct', 'Payment Structure'); echo Form::select('pay-struct', array( "weekly" => "Weekly", "fortnightly" => "Fortnightly" , "monthly" => "Monthly" ), Input::old('emp-type')); }}</li>
			<li> {{ Form::label('sal-type', 'Salary Type'); echo  Form::select('sal-type', array('annual' => 'Annually Rates', 'hour' => 'Hourly Rates') , array('class' => 'validate[required]', 'id'=>'sal-type')); }}</li>
			<li> {{ Form::label('min-salary', 'Minimum Salary'); echo  Form::text('min-salary', Input::old('min-salary'), array('class' => 'validate[required,custom[money], funcCall[salaryMinCheck]]', 'id'=>'min-salary')); }}</li>
			<li> {{ Form::label('max-salary', 'Maximum Salary'); echo Form::text('max-salary', Input::old('max-salary'), array('class' => 'validate[required,custom[money], funcCall[salaryMaxCheck]]', 'id'=>'max-salary')); }}</li>
			<!--			<li> {{ Form::label('min-salary', 'Minimum Salary'); echo  Form::select('min-salary', $min_salary , Input::old('min-salary'), array('class' => 'span1', 'id'=>'min-salary')); }}</li>
						<li> {{ Form::label('max-salary', 'Maximum Salary'); echo Form::select('max-salary', $max_salary , Input::old('max-salary'), array('class' => 'span1', 'id'=>'max-salary')); }}</li>-->
			<li> {{ Form::label('salary-range', 'Salary Description'); echo Form::text('salary-range', Input::old('salary-range'), array('maxlength' => 70, 'class' => 'validate[required]') ) }} <a href="#" rel="tooltip" data-toggle="tooltip" title="You can enter an interesting note for your salary description. E.g (Good $$$ with super). Only a maximum of 70 characters allowed."><i class="icon-question-sign"></i></a></li>

		</ul>
		<h4 style="clear: both">Custom "Apply Now" Button</h4>
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
				{{ Form::text('custom-apply', Input::old('job-apply'), array('id'=>'custom-apply', 'class' => 'validate[required,custom[url]]', 'placeholder' => 'http://www.example.com')) }}

			</li>

		</ul>
		<h4 style="clear: both">Please select a template</h4>
		<p><em>If no template is selected, the default template will be automatically assigned.</em></p>
		<input type="hidden" id="post-selected-template" value="" name="post-selected-template" />
		<ul class="post-templates" style="clear:both">
			@foreach ($templates as $template)
			<li class="template-item" data-id="{{ $template->id }}">
				<h5>{{ $template->name }}</h5>
				<figure>
					<img src="http://www.placehold.it/100x100/" alt="{{  $template->name }}" />
				</figure>
			</li>
			@endforeach
		</ul>

		{{ Form::submit("Next" , array('class' => 'btn btn-primary clearfix')); }} 
	</form>


</div>	

@endsection



@section('page-scripts')
$("#job-category").trigger("change");
$("#job-location").trigger("change");
@endsection