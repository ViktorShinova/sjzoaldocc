@layout('layout.admin')

@section('content')

<div class="span10">
	<h2>Edit Page</h2>
	<form method="post" action="/admin/page/edit/{{$page->id}}">
		
		<label>Title</label>
		<input type="text" placeholder="Title" name="title" value="{{$page->title}}">
		<label>Content</label>
		<textarea name="content" class="ckeditor">{{$page->content}}</textarea><br/>
		<button type="submit" class="btn btn-warning">Submit</button>
	
	</form>
</div>


@endsection
