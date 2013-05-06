@layout('layout.employer')
@section('content')
<h1 class="container-header">Email Review</h1>
<div class="content">
	
	<form action="/employer/email/review/{{$job_id}}" method="post">
	<div id="tab-container" class="tab-container">
		<ul class='etabs'>
			<li class='tab'><a id='success-btn' href="#success">Successful Applicant</a></li>
			<li class='tab'><a id='unccess-btn' href="#unsuccess">Unsuccessful Applicant</a></li>
		</ul>
		<div class="panel-container">
			
			<div id="success">
				@render('email.email-master', array('email_body' => $success_message, 'email_to' => $email_to, 'email_from' => $email_from, 'logo'=> $logo))
			</div>
			<div id="unsuccess">
				@render('email.email-master', array('email_body' => $unsuccess_message, 'email_to' => $email_to, 'email_from' => $email_from, 'logo' => $logo ))
			</div>
			
		</div>
	</div>
	<a id='back-btn' class="btn btn-primary"><i class="icon-backward icon-white"></i> Back </a>
	<button class="btn btn-primary"><i class="icon-envelope icon-white"></i> Send </button>
	</form>
	
</div>

@endsection


@section('page-script')

$('#success-btn, #unsuccess-btn').click( function (e) {

	e.preventDefault();

})

@endsection