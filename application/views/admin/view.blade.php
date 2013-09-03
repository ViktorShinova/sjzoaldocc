@layout('layout.admin')
@section('custom_styles')

@if(isset($job1->template)) 
<?php $data = unserialize($job1->template->data); ?>
<style>
	{{ $job1->template->css }}
</style>
@endif
@endsection

@section('content')

<div class="row">


	<section class="notice-container span8 white-bg drop-shadow-black">
		<header class="notice-header">

			@if( isset($data['header-image']) && $data['title-type'] == 'image' ) 
			<img src="{{$data['header-image']}}" />
			@else
			<h1>{{ $job->title }}</h1>
			@endif

		</header>
		<article class="notice-body">
			{{ $job->description }}
		</article>
		<footer class="notice-footer">
			<p>{{ $job->contact }}</p>
		</footer>
	</section>


		
@endsection
