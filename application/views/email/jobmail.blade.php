<!DOCTYPE HTML>

<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style="background: #efebe2; font-family: helvetica, sans-serif; padding:20px;">
		
		<ul style="width: 800px; margin:0 auto;">

			@foreach($jobs as $job)
			<li style="background: #f8f8f8;	border: solid 1px #dedede;	box-shadow: inset 0 0 10px #dddddd;	clear: both;list-style: none;padding: 20px;	margin-bottom: 21px;position: relative;">
				<div>
					<div style="-moz-box-sizing: border-box;-webkit-box-sizing: border-box;	-ms-box-sizing: border-box;	box-sizing: border-box;	float: left;width: 66%;	padding-right: 15px;">
						<h2 style="color: #d9531d;font-family: 'Lato', sans-serif;font-weight: 600;	font-size: 18px;line-height: 24px;margin: 0;"><a style="color: #38342b;" href="/job/article/{{$job->slug}}">{{$job->title}}</a></h2>
						<p style="font-family: helvetica, sans-serif;font-size: 12px;line-height: 21px;"><a title="Find more from this category." class="category" href="{{$_SERVER['HTTP_HOST']}}/job/search?job-category={{$job->category_id}}">{{ $job->category_name }}</a></p>
						<p style="font-family: helvetica, sans-serif;font-size: 12px;line-height: 21px;">
							{{$job->summary}}
						</p>
					</div>

					<div style="width: 30%;float: right;">
						<h4 style="text-transform: uppercase;color: #38342b;font-family: 'Helvetica', sans-serif;font-weight: 400;margin-top: 0;"><a style="color: #38342b;" href="{{$_SERVER['HTTP_HOST']}}/job/search?employer-id={{$job->employer_id}}" title="Find more from the same employer.">{{ $job->company }}</a></h4>
						<span style="font-size: 12px;display: block;margin-bottom: 10px;"class="location">{{ $job->location_name }}, {{ $job->sub_location_name }}</span>
						<span style="font-size: 12px;display: block;margin-bottom: 10px;color: #222222;	font-weight: bold;"class="salary">{{ $job->salary_range }}</span>
						<span style="font-size: 12px;display: block;margin-bottom: 10px;"class="date">
							{{	Formatter::format_date($job->created_at, Formatter::DATE_LONG_W_TIME); }}
						</span>
					</div>
				</div>
				<div style="width: 30%;	clear: both;float:right">
					<a href="{{$_SERVER['HTTP_HOST']}}/job/article/{{$job->slug}}" style="display: inline-block;padding: 4px 12px;margin-bottom: 0;font-size: 12px;font-family: 'Helvetica', sans-serif !important;font-weight: 400 !important;line-height: 20px;color: white;text-align: center;vertical-align: middle;cursor: pointer;background-color: #99cc33;	border: 0;color: white;text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);background: #f09216;width: 80px;">View<i class="icon-chevron-sign-right"></i></a>
				</div>
				<div style="clear: both;"></div>
			</li>
			@endforeach


		</ul>
		<!-- #listings -->

	</body>

</html>