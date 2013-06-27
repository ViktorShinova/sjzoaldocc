@layout('layout.admin')

@section('content')

<div class="span10">
	<form>
		<fieldset>
			<legend>Page</legend>
			<label>Title</label>
			<input type="text" placeholder="Title">
			<label>HTML</label>
			<textarea></textarea>
			<button type="submit" class="btn btn-primary">Submit</button>
		</fieldset>
	</form>
</div>


@endsection