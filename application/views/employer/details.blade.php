@layout('layout.employer')
@section('page-id')page-details@endsection
@section('content')
<h1 class="container-header">Advertisement Details</h1>
<div class="content">
	<p>Individual candidate's application is sent to your nominated "Applicant's email address".</p>
	<br/>
	@if ( Session::has('error_message') )
	<div class="validation error">
		<p>Please correct the following errors</p>
		<ul>
			
			<li>{{ Session::get('error_message') }}</li>
		
		</ul>
	</div>
	@endif
	<form action="/employer/post/details/{{$job->id}}" method="post" class="employer-form  validate-form form  email-form">
	@if(count($applicants->results) != 0 )
	<div class="table-container">
        <div class="table-header-wrapper">
            <h2 class="table-header">{{$job->title}}</h2>
        </div>
		<table>
			<tr class="table-header-row">
				<th>Applicant</th>
				<th>Contact Details</th>
				<th>Skill Set</th>
				<th>Cover Letter / Resume</th>
				<th>Accept</th>
				<th>Reject</th>
				<th>Mail</th>
			</tr>
			@foreach( $applicants->results as $applicant )
			<tr class="table-data-row">
				<td><a href="/applicant/profile/{{$applicant->applicant_id}}">{{ $applicant->first_name }} {{$applicant->last_name}}</a></td>
				<td style="width: 200px;">Email: {{ $applicant->email }}</td>
				<td style="width: 90px;">
					@if($applicant->skills)
						<a rel="popover" class="btn btn-small" data-toggle="popover" data-placement="bottom" data-content="<ul>
							 @foreach( unserialize($applicant->skills) as $skill )
							 <li>{{ $skill }}</li>
							 @endforeach
						</ul>" data-original-title="Skill sets">View Skills</a>
					
					
					@else
					No skill set entered
					@endif
				</td>	
				<td style="width: 150px;">
					@if (!$applicant->cover_letter)
						No cover letter
					@else
					<a href="#" rel="popup">Cover Letter</a>
					@endif
					/
					@if (!$applicant->path)
						No resume attached
					@else
					<a href="{{$applicant->path}}" rel="popup">Resume</a>
					@endif
				</td>
				<td style="text-align:center; width: 50px">	
					<input name="job-accept[{{$applicant->applicant_id}}]" type="radio" value="accept"/>
				</td>
				<td style="text-align:center; width: 50px">
					<input name="job-accept[{{$applicant->applicant_id}}]" type="radio" value="reject"/>
				</td>
				<td style="text-align:center; width: 50px">
					@if($applicant->sent == 1)
					<i class="icon-ok"></i>
					@else
					<input type='checkbox' name="send-mail[{{$applicant->applicant_id}}]">
					@endif
					<input type="hidden" name="applied_id[]"  value="{{$applicant->applied_id}}"/>
				</td>
			</tr>
			@endforeach
		</table>

    </div>
	@else
	<p><strong>No applicant has applied to this position yet.</strong></p>
	<br/>
	
	@endif
	
		<h4>Email</h4>
		<p>Carreerhire offers you a simple and efficient way to notify your applicants of the outcome of their application. Please enter a success and unsuccessful message and Careershire will, on your behalf, notify each and every applicants above.</p>
		<br/>
		<ul>
			<!--<li>
					<label>
						Subject:
					</label>
					<input class='email-text' type='text' name='email-subject' id='email-subject' />
				</li>-->
			<li>
				<label for='email-success'>
					To Successful Applicant: 
				</label>
				{{ Form::textarea('email-success', Session::has('success_message') ? Session::get('success_message') : '', array('class' => 'email-textarea ckeditor', 'id' => 'email-success')) }}
				
			</li>
			<li>
				<label for='email-unsuccess'>
					To Unsuccessful Applicant:
				</label>
				{{ Form::textarea('email-unsuccess', Session::has('unsuccess_message') ? Session::get('unsuccess_message') : '', array('class' => 'email-textarea ckeditor', 'id' => 'email-unsuccess')) }}
				
			</li>
		</ul>
		
		<button type='submit' class='btn btn-primary'><i class='icon-envelope icon-white'></i>Next</button>
	</form>


</div>

@endsection