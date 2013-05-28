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


<table>
	@if( count($expertises) != 0 ) 
	<tr>
		<th>Expertise</th>
		<th class="controls"></th>
	</tr>
	@foreach($expertises as $expertise)
	<tr>
		<td>
			{{$expertise}}
		</td>
		<td>
			<a href="#" class="btn btn-warning btn-mini exp-edit" data-value="{{$expertise}}"><i class="icon-pencil"></i></a>
			<a href="#" class="btn btn-danger btn-mini exp-remove" data-value="{{$expertise}}"><i class="icon-remove"></i></a>
		</td>
	</tr>
	@endforeach
	@endif
</table>