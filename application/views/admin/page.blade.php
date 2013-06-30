@layout('layout.admin')

@section('content')

<div class="span10">
	<form method="post" action="/admin/page/">
		<fieldset>
			<legend>Page</legend>
			<label>Title</label>
			<input type="text" placeholder="Title" name="title">
			<label>HTML</label>
			<textarea name="html"></textarea>
			<button type="submit" class="btn btn-primary">Submit</button>
		</fieldset>
	</form>
</div>


@endsection


@section('scripts') 
<script src="/js/vendor/markitup/jquery.markitup.js"></script>
<!-- markItUp! toolbar settings -->
<script src="/js/vendor/markitup/sets/default/set.js"></script>
@endsection

@section('page-scripts')

 $(document).ready(function() {
	$("textarea").markItUp(mySettings);
 });

@endsection