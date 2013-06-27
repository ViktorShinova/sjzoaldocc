@layout('layout.employer')
@section('page-id')page-invoice@endsection
@section('content')
<h2>Payment Transactions</h2>


<div class="table-container">
	<div class="table-header-wrapper">
		<h2 class="table-header">Transaction History</h2>
	</div>
	<table>
		<tr class="table-header-row">
			<th style="width:50%">Title</th>
			<th>Billed on</th>
			<th>Paid by</th>
			<th>Amount</th> 
			<th></th>
		</tr>
		@foreach( $invoices->results as $invoice )
		<tr class="table-data-row">
			<td>{{ $invoice->title }}</td>
			<td>{{ Formatter::format_date($invoice->created_at, Formatter::DATE_LONG_W_TIME) }}</td>
			<td>{{ $invoice->payment_type }}</td>
			<td>{{$invoice->local_currency_code}}$ {{ Formatter::format_dollar($invoice->amount )}}</td>
			<td><a href="#" rel="popup">View</a></td>
		</tr>
		@endforeach
	</table>

</div>


@endsection