<!DOCTYPE html">
<html>
	<head>
		<title>Email to a friend</title>
		<link rel="Shortcut Icon" href="/favicon.ico" type="image/x-icon" />
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		{{ HTML::style('/css/main.css') }}
		
	</head>
	<body> 
		
		<div class='container'>
			<h2>Email this Job Post to your friends</h2>
			<div class='row>'
				 <form class="form-horizontal" method='post' action='/job/mail/{{$id}}'>
			<div class="control-group">
				<label class="control-label" for="sender-name">Your name:</label>
				<div class="controls">
					<input type="text" id="sender-name" placeholder="Name" name='sender_name' class='input-large'>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="friends-name">Friend's name:</label>
				<div class="controls">
					<textarea  class='input-large'  rows='5' id="friends-name" name='friend_names'></textarea>
					<br/><em>Please enter new names on a new line or separate them using ';'.</em>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="friends-email">Friend's email:</label>
				<div class="controls">
					<textarea  class='input-large' rows='5' id='friends-email' name='friend_emails'></textarea>
					<br/><em>Please enter new email address on a new line or separate them using ';'.</em>
				</div>
				<div class='controls'>
					<button type="submit" class="btn btn-primary">Send</button>
				</div>
			</div>
			
			
		</form>
		</div>
		</div>

		@include ('layout.footer-scripts')

	</body>
</html>