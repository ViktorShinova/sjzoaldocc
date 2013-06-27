@layout('layout.employer')
@section('page-id')page-template@endsection
@section('content')

<h2>Custom Templates</h2>

<p class="intro">Careershire offer you the ability to create your own template at no extra cost! Please take a couple of minutes to read through the following instruction before creating a template.
</p>
<br/>
<div class="table-container">
	<div class="table-header-wrapper">
		<h2 class="table-header">Template List</h2>
		<div class="table-toolbar">
			<a href="/employer/template/create"><i class="icon-plus-sign icon-white"></i>Create New Template</a>
		</div>
	</div>
	<table>
		<tr class="table-header-row">
			<th>Name</th>
			<th>Date created</th>
			<th>Date modified</th>
			<th>Status</th>
			<th>Posts</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
		@foreach( $templates->results as $template )
		<tr class="table-data-row">
			<td>{{ $template->name }}</td>
			<td>{{ $template->created_at }}</td>
			<td>{{ $template->updated_at }}</td>
			<td>Active</td>
			<td>{{--$template->jobs--}}</td>
			<td><a href="/employer/template/preview/{{$template->id}}" rel="popup" class="template-preview">Preview</a></td>
			<td><a class="template-edit" href="/employer/template/create/{{$template->id}}">Edit</a></td>
			<td><a class="template-delete" href="/employer/template/delete/{{$template->id}}">Delete</a></td>
		</tr>
		@endforeach
	</table>

</div>




@endsection