<?php
session_start();
ini_set('display_error', 0);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$name = $_POST['name'];
	$email = $_POST['email'];

	$pdo = new PDO('mysql:host=phpmyadmin.careershire.com;dbname=careershire', 'careershire', '0405470F');

	$query = "insert into before_launch (name, email) values (:name, :email);";
	$param = array($name, $email);

	$stmt = $pdo->prepare($query);
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':email', $email);
	$result = $stmt->execute();

	if ($result) {

		$_SESSION['success'] = true;
		header('Location: /');
		die();
	}
}
?>


<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->

	<head>

		<title>CareersHire - Looking for careers? </title>

		<meta charset="utf-8" />

		<meta name="description" content="CareersHire will be launching soon. Sign up with us now for more information." />
		<meta name="keyword" content="career, job, hire, job seeker, work, seek, indeed, my career, job database, job website, get a job">
		<meta name="robots" content="index,follow" />
		<meta name="revisit-after" content="7 days" />
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" href="/css/main.css" />
		<script src="/js/vendor/modernizr-2.6.2.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
		<script src="/js/plugins.js"></script>
		<script src="/js/site.js"></script>
		<style>
			body { margin-top: 60px;}
			h1 {
				font-size: 58px;
				color: #38342b;
				font-family: 'Lato', sans-serif;
				font-weight: 600;
				margin-bottom: 21px;
				text-align: center;
				margin-bottom: 54px;
			}
			.careers {
				color: #a24c44;
			}
			.hire { color: #f09216;}

			form { width: 500px; margin: 0 auto;}
			label { width: 150px !important;}
			button { margin-left: 150px;}

		</style>
	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class="span12" id="content">
					<h1><span class="careers">Careers</span><span class="hire">Hire</span> will be launching soon</h1>


					<form action="" method="post" class="validate-form" >
<?php if (isset($_SESSION['success']) && $_SESSION['success']) : ?> 

							<div class="validation success">
								<p>Thank you for subscribing to us. We will keep you posted on our latest update. </p>
							</div>

	<?php unset($_SESSION['success']);
endif; ?>
						<p>Subscribe with us to get the latest update on our progress</p>
						<ol>
							<li><label>Name: </label> <input type="text" name="name" class="validate[required]"/></li>
							<li><label>Email: </label> <input type="text" name="email" class="validate[required,custom[email]]"/></li>
							<li><button class="btn	" type="submit">Sign up</button></li>
						</ol>

					</form>
				</div>
			</div>
		</div>
    </body>

</html>