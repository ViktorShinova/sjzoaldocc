@layout('layout.admin')

@section('content')

<h2>User Management</h2>
	
	<div class="table-container">
		<table>
			<thead>
			<tr class="table-header-row">
				<th>Username</th>
				<th>Created on</th>
				<th>Modified on</th>
				<th>Role</th>
				<th>Login</th>
			</tr>
			</thead>
			@foreach($users as $user)
			<tr class="table-data-row">
				<td><a rel="external" href="/user/view/{{$user->id}}">{{ $user->username }}</a></td>
				<td>{{ Formatter::format_date($user->created_at, Formatter::DATE_SHORT_W_TIME) }}</td>
				<td>{{ Formatter::format_date($user->updated_at, Formatter::DATE_SHORT_W_TIME) }}</td>
				<td>{{$user->role->name}}</td>
				<td><a href='/admin/user/login/{{$user->id}}'>Login</a></td>
			
			</tr>
			@endforeach
		</table>

    </div>

@endsection