<?php

define('PUBLIC_DIR',				"public/");
define('COMPANY_NAME',              "Careershire");

define('ACCOUNT_EMAIL',             'accounts@careershire.com.au');
define('NOREPLY_EMAIL',				'noreply@careershire.com.au');

define('SMTP',                      'smtp.gmail.com');
define('SMTP_USERNAME',             'careerdb.coy@gmail.com');
define('SMTP_PASSWORD',             '0405470F');


define('UPLOAD_DIR',				PUBLIC_DIR . 'uploads/');
define('IMAGE_DIR',					PUBLIC_DIR . 'img/');
define('TMP_IMAGE_FOLDER',			UPLOAD_DIR . 'tmp/');
define('APP_TMP_FOLDER',			TMP_IMAGE_FOLDER . 'applicant/');
define('EMP_TMP_FOLDER',			TMP_IMAGE_FOLDER . 'employer/');
define('APP_UPLOAD_DIR',				UPLOAD_DIR . 'applicant/');
define('EMP_UPLOAD_DIR',				UPLOAD_DIR . 'employer/');
define('SHORTLIST', 				0);
define('APPLIED', 					1);
define('REJECTED', 					2);
/*PAYPAL*/
define('PAYPAL_CONFIRM', 'http://careershire.localhost/employer/payment/confirm' );
define('PAYPAL_CANCEL', 'http://careershire.localhost/employer/payment/cancel');

define('TRANSACTION_TABLE',			'transactions');
define("DBNAME",					"careershire");
define("DATABASE_CONNECTION",		"mysql:host=localhost;dbname=". DBNAME);
define("DATABASE_USER",				"careersAdmin");
define("DATABASE_PWD",				"c@reErsH1re");

define('PAYPAL_TYPE',				'PAYPAL');
define('EWAY_TYPE',					'EWAY- CREDIT CARD');

define('CAPTCHA_PUB_KEY',			'6LctUeQSAAAAAN0rlXBAK3iOanmR85Nbvnm8Ip_X');
define('CAPTCHA_PRIVATE_KEY',		'6LctUeQSAAAAAHfWR_gJ_txofetinsg5D3sCxy3Q');