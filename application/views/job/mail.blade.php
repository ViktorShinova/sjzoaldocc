<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->

	<head>

		<title></title>

		<meta charset="utf-8" />

		<meta name="description" content="" />

		<meta name="robots" content="index,follow" />
		<meta name="revisit-after" content="7 days" />
		<link rel="shortcut icon" href="favicon.ico" />
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
		<!--[if lt IE 9]>
		{{ HTML::style('/css/font-awesome-ie7.min.css') }}
		<![endif]-->	

		{{ HTML::style('/css/main.css') }}
		{{ HTML::style('/css/font-awesome.min.css') }}
		<script src="/js/vendor/modernizr-2.6.2.min.js"></script>
		<style>
			#content { margin-top: 0;}
		</style>
	</head>
	<body> 

		<div class='container' id='content'>
			<h3>Email this Post</h3>
			<div class='row'>
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
				<form class="form-horizontal validate-form" method='post' action='/job/mail/{{$id}}'>
					<div class="control-group">
						<label class="control-label" for="sender-name">Your name:</label>
						<div class="controls">
							<input type="text" id="sender-name" placeholder="Name" name='sender_name' class='input-large validate[required]' data-prompt-position='topLeft:70'>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="friends-name">Friend's name:</label>
						<div class="controls">
							<input type='text' class='input-large validate[required]' data-prompt-position='topLeft:70' id="friends-name" name='friends_name' />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="friends-email">Friend's email:</label>
						<div class="controls">
							<input type='text' class='input-large validate[required,custom[email]]' data-prompt-position='topLeft:70' id="friends-email" name='friends_email'/>
						</div>

					</div>
					
					<div class="control-group">
						<div class="controls">
							{{Recaptcha::recaptcha_get_html(CAPTCHA_PUB_KEY);}}
						</div>
					</div>
					<div class="control-group">
						
						<div class="controls">
							<button type="submit" class="btn btn-warning">Send</button>
						</div>

					</div>

				</form>
			</div>
		</div>

		@include ('layout.footer-scripts')

	</body>
</html>