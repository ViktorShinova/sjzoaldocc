@layout('layout.blank')
@section('custom_styles')

	@if(isset($template)) 
	<style>
	{{ $template->css }}
	</style>
	@endif
@endsection

@section('content')

@render('employer.template', array('data' => $data))


@endsection