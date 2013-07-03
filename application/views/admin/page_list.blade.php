@layout('layout.admin')

@section('content')
<div class="span10">
	<h2>Pages</h2>
	
	<div class="table-container drop-shadow-butterfly">
        <div class="table-header-wrapper">
			<div class="table-toolbar">
				<a href="/admin/page/"><i class="icon-plus-sign icon-white"></i>Add a new page</a>
			</div>
        </div>
		<table>
			<tr class="table-header-row">
				<th>Title</th>
				<th>Created on</th>
				<th>Modified on</th>
				<th></th>
				<th></th>
			</tr>
			@foreach($pages as $page)
			<tr class="table-data-row">
				<td><a rel="external" href="/page/{{$page->slug}}">{{ $page->title }}</a></td>
				<td style="width: 250px;">{{ Formatter::format_date($page->created_at, Formatter::DATE_LONG_W_TIME) }}</td>
				<td style="width: 250px;">{{ Formatter::format_date($page->updated_at, Formatter::DATE_LONG_W_TIME) }}</td>

				<td style="text-align:center; width: 10px;"><a title="Edit" href="/admin/page/edit/{{$page->id}}"><i class="icon-edit"></i></a></td>
				<td style="text-align:center; width: 10px;"><a title="Delete" href="/admin/page/delete/{{$page->id}}" class="job-delete"><i class="icon-trash"></i></a></td>
			</tr>
			@endforeach
		</table>

    </div>
</div>
@endsection