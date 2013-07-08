@layout('layout.employer')
@section('page-id')page-post@endsection
@section('content')

<h2>Payment Successful</h2>

	<p>Your payment has been successfully processed.</p>
	<section role="contentinfo" class="receipt">
		
		<p>A copy of the receipt below has been sent to your nominated email address. Please keep it safe for future reference.</p>
		<br/>
			
		<div class="table-container">
		<div class="table-header-wrapper">
			<h2 class="table-header">Payment Summary</h2>
		</div>
		<table>
			<tr class="table-header-row">
				<th style="width:80%">Advertisement title</th>
				<th>Quantity</th>
				<th>Price</th>
				
			</tr>

			<tr class="table-data-row">
				<td>{{ $post['title'] }}</td>
				<td style="width:100px">1</td>
				<td>AUD ${{ Formatter::format_dollar($price) }}</td>
				
			</tr>
			<tr class="table-data-row">
				<td></td>
				<td class="total" style="width:100px">Total</td>
				<td style="width:100px">AUD ${{ Formatter::format_dollar($price) }}</td>
			</tr>
		</table>

	</div>
	</section>

	<a class="btn btn-warning print-button pull-right" href="#" id="print" ><i class="icon-print icon-white"></i> Print</a>	
	
</div>

@endsection