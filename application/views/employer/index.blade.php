@layout('layout.level2')



@section('content')

<div class="row">
	<div class="span12">
		<div class="wrapper">

			<div class="row">

				<div class="emp-home span9 white-bg drop-shadow">


					<div class="notice">
						<h3>Join us now!</h3>
						<p>CareersHire is celebrating it's launch!</p>
						<p>Post unlimited post for <strong>Free</strong> now! <br/> Yes. You heard that right. <strong>For FREE!</strong> </p>
						<p>What are you waiting for? <br/><br/><a class='btn btn-warning' href='/employer/register/'>Sign up for an account now! </a></p>
					</div>
					<div class="login">
						<h3>Already Registered?</h3>
						<form class="validate-form" action="/login" method="post">
						
							<ol>
								<li> {{ Form::text('username', Input::old('username') , array('class' => 'validate[required]', 'placeholder' => 'Email/Username')); }}</li>
								<li> {{ Form::password('password' ,  array('class' => 'validate[required]', 'placeholder' => 'Password')); }} </li>
								<li>{{ Form::submit("Login" , array('class' => 'btn btn-warning', 'style' => 'margin-top: 0')); }}</li>
								<li><a class="reset-pwd" href="/resetpassword">Can't access your account?</a></li>
							</ol>
							
						
					</form>
						
					</div> 


				</div>
				

			</div>

		</div>
	</div>
</div>



@endsection