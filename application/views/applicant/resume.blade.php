@if ( isset ( $message ) ) 

<div class="validation success">
	<p>
		{{ $message }}
	</p>
</div>

@endif

@if ( isset ( $error ) ) 

<div class="validation error">
	<p>
		{{ $error }}
	</p>
</div>

@endif


<ul class="listing" id="resume-listing">
	@foreach ($resumes as $resume)
	<li class="item">
		<button class="btn btn-mini btn-danger remove pull-right" type="button" id="r{{ $resume->id }}"><i class="icon-remove"></i></button>
		<a href="{{ $resume->path }}" target="_blank">
			<span class="icon {{ $resume->type }}"></span>
		</a>
		<span class="title"><a href="{{ $resume->path }}" target="_blank">{{ $resume->resume }}</a></span>
		<span class="filesize">{{ Formatter::format_bytes($resume->filesize, 0) }}</span>
		<span class="date-upload">{{ Formatter::format_date($resume->created_at, Formatter::DATE_SHORT) }}</span>
	</li>
	@endforeach
</ul>