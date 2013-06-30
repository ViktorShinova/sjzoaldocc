
#content .notice-container > header {
	@if( isset($temp['header-repeat']) )
	background-repeat: {{$temp['header-repeat']}} ;
	@endif
	@if( isset($temp['header-background']) )
	background-image: {{$temp['header-background']}};
	@endif
	
	@if( isset($temp['header-position']) )
	background-position: {{$temp['header-position']}};
	@endif
	
	@if( isset($temp['hbg-color']) )
	background-color: {{$temp['hbg-color']}};
	@endif
	
	@if( isset($temp['head-text-align']) )
	text-align: {{$temp['head-text-align']}};
	@endif
	
}

#content .notice-container > header > h1 {
	@if( isset($temp['title-color']) )
	color: {{$temp['title-color']}};
	@endif
}

#content .notice-container > article {

	@if( isset($temp['body-repeat']) )
	background-repeat: {{$temp['body-repeat']}};
	@endif
	@if( isset($temp['body-background']) )
	background-image: {{$temp['body-background']}};
	@endif
	@if( isset($temp['body-position']) )
	background-position: {{$temp['body-position']}};
	@endif
	@if( isset($temp['bbg-color']) )
	background-color: {{$temp['bbg-color']}};
	@endif
}

#content .notice-container > article > p {
	@if( isset($temp['body-color']) )
	color: {{$temp['body-color']}};
	@endif
}

#content .notice-container > footer {

	@if( isset($temp['footer-repeat']) )
	background-repeat: {{$temp['footer-repeat']}};
	@endif
	@if( isset($temp['footer-background']) )
	background-image: {{$temp['footer-background']}};
	@endif
	@if( isset($temp['footer-position']) )
	background-position: {{$temp['footer-position']}};
	@endif
	@if( isset($temp['fbg-color']) )
	background-color: {{$temp['fbg-color']}};
	@endif

}

#content .notice-container > footer > p {
	@if( isset($temp['footer-color']) )
		color: {{$temp['footer-color']}};
	@endif
}
