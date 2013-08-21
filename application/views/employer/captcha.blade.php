@layout('layout.employer')
@section('header-scripts')

@endsection
@section('page-id')page-payment@endsection

@section('content')
<h2>Review your Job Advertisement</h2>
<p>CareersHire is celebrating it's first launch. All advertisement posted in CaeersHire will be free.</p>
<br/>
<div class="table-container drop-shadow-butterfly">
	<div class="table-header-wrapper">
		<h2 class="table-header">Payment Summary</h2>
	</div>
	<table>
		<tr class="table-header-row">
			<th class="title">Advertisement title</th>
			<th></th>
			<th class="price">Price</th>
			<th></th>
		</tr>

		<tr class="table-data-row">
			<td colspan="2">{{ $post['title'] }}</td>

			<td>AUD ${{ Formatter::format_dollar($price->price) }}</td>
			<td><a class="post-delete" href="/employer/post/remove" class="template-edit"><i class="icon-trash"></i></a></td>
		</tr>
		<tr class="table-data-row">
			<td></td>
			<td class="total">Total</td>
			<td colspan='2'>AUD ${{ Formatter::format_dollar($price->price) }}</td>


		</tr>
	</table>




</div>
<p>Please enter the text below</p>

@if ( Session::has('error') ) 
<div class='validation error'>
	<p>
		{{Session::get('error')}}
	</p>
</div>
@endif

<form class="employer-form  validate-form form " method="post" action="/employer/payment/submit">
	{{Recaptcha::recaptcha_get_html(CAPTCHA_PUB_KEY);}}
	<input type="submit" class="btn btn-warning clearfix" value="Vertify!"/>
</form>
@endsection


@section('scripts')
<script src="https://www.paypalobjects.com/js/external/dg.js"></script>
@endsection

@section('page-scripts')
dg = new PAYPAL.apps.DGFlow({
trigger: 'paypal_submit',
expType: 'instant'
});
@endsection


