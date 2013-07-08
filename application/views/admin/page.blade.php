@layout('layout.admin')

@section('content')

<div class="span10">
	<h2>Add New Page</h2>
	<form method="post" action="/admin/page/">
		
			<label>Title</label>
			<input type="text" placeholder="Title" name="title">
			<label>Content</label>
			<textarea name="content" class="ckeditor"></textarea><br/>
			<button type="submit" class="btn btn-warning">Submit</button>
	
	</form>
</div>


@endsection

