@layout('layout.blank')
@section('custom_styles')

	@if(isset($template)) 
	<style>
	{{ $template->css }}


	.notice-container > header > h1 {
	display: inline;
	position: relative;
	line-height: 21px;
	font-size: 21px;
	color: #6C6C6C;
	text-shadow: 0px 1px 0 rgba(255, 255, 255, 0.6);
	/* this is adjustable */
	}

	.notice-container > article {
		height: auto;
		margin-bottom: 5px;
	}
	.notice-container > article p {
			line-height: 18px;
	}

	.notice-container > article h2 {
		font-size: 18px;
		line-height: 32px;
		color: #6C6C6C;
		text-shadow: 0px 1px 0 rgba(255, 255, 255, 0.6);		
	}

	</style>
	@endif
@endsection

@section('content')

@include('employer.template')

@endsection