<html>
<head>
	<title>Careershire Account Information changed</title>
</head>
<body style="font-family: Helvetica, Arial;">
	<div style="border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;border: 1px solid #ccc;box-shadow: 0 0 35px rgba(0, 0, 0, 0.3);margin: 0 auto;padding: 20px 50px;width: 90%;">
		<h1 style="color: black;font-size: 24px;line-height: 30px;">Account information changed</h1>
                <p style="color: black;font-size: 12px;">Dear {{ $user->username }}</p>
		<p style="color: black;font-size: 12px;">You have recently changed your account information on Careershire. If this is not your intention, please click on the button below immediately.</p>
		<a style="text-decoration: none;border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;background: #006dbc;border: 1px solid navy;border-color: #006dbc #004475 #002a80;color: white;display: inline-block;font-size: 12px;padding: 20px;" href="http://careershire.localhost/reset?reset={{$uuid}}">Reset Account</a>
		<p style="color: black;font-size: 12px;">Please ignore this email if you requested the change. Your account will be irreversible after 7 days.</p>

		<p><em></em></p>
	</div>
</body>

</html>