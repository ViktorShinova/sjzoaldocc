@layout('layout.employer')
@section('page-id')page-email@endsection
@section('content')
<h1 class="container-header">Email Templates</h1>
<div class="content">
	<p>
		This email feature allows you to quickly send mail(s) to your applicant to notify them of the result. Please update your success and unsuccessful messages.
	</p>
	
	<br/>
	
	<p>
		<em>
			Before proceeding, please read our <a href='#' title='Email User Guide'>guide</a>.
		</em>
	</p>
	<br/>
	<form action="/employer/email/update" method="post" class="employer-form validate-form email-form">
		
		<ul>
		<!--			<li>
				<label>
					Subject:
				</label>
				<input class='email-text' type='text' name='email-subject' id='email-subject' />
			</li>-->
			<li>
				<label for='email-success'>
					To Successful Applicant: 
				</label>
				<textarea class='email-textarea' id='email-success' name='email-success'></textarea>
			</li>
			<li>
				<label for='email-unsuccess'>
					To Unsuccessful Applicant:
				</label>
				<textarea class='email-textarea' id='email-unsuccess' name='email-unsuccess'></textarea>
			</li>
		</ul>
		
	</form>
	
	
</div>
@endsection