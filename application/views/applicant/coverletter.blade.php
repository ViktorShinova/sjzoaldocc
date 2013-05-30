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

<ul class="listing" id="coverletter-listing">
	@foreach ($coverletters as $coverletter)
	<li class="item">
		<button class="btn btn-mini btn-danger remove pull-right" type="button" id="{{ $coverletter->id }}"><i class="icon-remove"></i></button>
		<a href="{{ $coverletter->path }}" target="_blank">
			<span class="icon {{ $coverletter->type }}"></span>
		</a>
		<span class="title"><a href="{{ $coverletter->path }}" target="_blank">{{ $coverletter->coverletter }}</a></span>
		<span class="filesize">{{ Formatter::format_bytes($coverletter->filesize, 0) }}</span>
		<span class="date-upload">{{ Formatter::format_date($coverletter->created_at, Formatter::DATE_SHORT) }}</span>
	</li>
	@endforeach
</ul>