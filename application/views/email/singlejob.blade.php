<!DOCTYPE HTML>

<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<style>
			p {font-size: 12px;
			   line-height: 21px;}
			</style>
		</head>
		<body style="background: #efebe2; font-family: helvetica, sans-serif; padding:20px;">
		<p>Dear {{$name}}</p>
		<p>Your friend has recommended a job for you.</p>
		<div style="margin:0 auto;max-width: 768px;border: 1px solid #dadada;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;-ms-box-sizing: border-box;box-sizing: border-box;background: white;width: 770px;">
			<div style="background: white;height: 120px;">
				<h1 style="color: #333333;font-family: 'Lato', sans-serif;font-weight: 600;font-size: 24px;margin: 0;margin: 0 20px 0 20px;padding-top: 46px;">{{ $job->title }}</h1>
			</div>
			<div style="padding-top: 30px;padding-bottom: 30px;background: white;padding: 0 20px;width: 100%;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;" class="notice-body">
				{{ $job->description }}
			</div>
			<div style="background: white;padding: 0 20px;width: 100%;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;" class="notice-footer">
				<p style="font-size: 12px;line-height: 21px;">{{ $job->contact }}</p>
			</div>
			<a style="text-decoration: none;display: inline-block;padding: 4px 12px;margin-bottom: 0;font-size: 12px;font-family: 'Helvetica', sans-serif !important;font-weight: 400 !important;line-height: 20px;color: white;text-align: center;vertical-align: middle;cursor: pointer;background-color: #99cc33;	border: 0;color: white;text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);background: #f09216;width: 80px;" href="http://{{$_SERVER['HTTP_HOST']}}/job/article/{{$job->slug}}">View this job</a>

		</div>
	</body>

</html>