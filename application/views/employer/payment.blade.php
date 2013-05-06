@layout('layout.employer')
@section('header-scripts')

@endsection
@section('page-id')page-payment@endsection

@section('content')
<h1 class="container-header">Review your purchase</h1>
<div class="content">
	<p>You are about to make payment for the following Advertisement(s).</p>
	<br/>
	<div class="table-container">
		<div class="table-header-wrapper">
			<h2 class="table-header">Payment Summary</h2>
		</div>
		<table>
			<tr class="table-header-row">
				<th>Advertisement title</th>
				<th>Quantity</th>
				<th>Price</th>
				<th></th>
			</tr>

			<tr class="table-data-row">
				<td>{{ $post['title'] }}</td>
				<td>1</td>
				<td>{{ $price->price }}</td>
				<td><a class="post-delete" href="/employer/post/remove" class="template-edit">Remove</a></td>
			</tr>
			<tr class="table-data-row">
				<td></td>
				<td class="total">Total</td>
				<td colspan='2'>{{ $price->price }}</td>
			</tr>
		</table>

	</div>
	<h4>Please choose a following payment option</h4>

	<div id="tab-container" class="tab-container">
		<ul class='etabs'>
			<li class='tab'><a href="#credit-card">Credit Card</a></li>
			<li class='tab'><a href="#paypal">Paypal</a></li>
		</ul>
		<div class="panel-container">

			<div id="credit-card">
				<form class="employer-form validate-form" method="post" action="/employer/payment/submit">
					<h4>Billing information</h4>
					<ul>
						<li>
							<label>First Name</label>
							<abbr title="required">*</abbr>
							<input class="validate[required]" type="text" name="bill_fname"/>
						</li>
						<li>
							<label>Last Name</label>
							<abbr title="required">*</abbr>
							<input class="validate[required]" type="text" name="bill_lname"/>
						</li>
						<li>
							<label>Contact</label>
							<abbr title="required">*</abbr>
							<input class="validate[required]" type="text" name="bill_contact"/>
						</li>
						<li>
							<label>Billing Address</label>
							<abbr title="required">*</abbr>
							<input class="validate[required]" type="text" name="bill_address"/>
						</li>
						<li>
							<label class="not-required">Billing Address 2</label>
							<input type="text" name="bill_address2"/>
						</li>
						<li>
							<label>Billing Suburb</label>
							<abbr title="required">*</abbr>
							<input class="validate[required]" type="text" name="bill_suburb"/>
						</li>
						<li>
							<label>Billing State</label>
							<abbr title="required">*</abbr>
							<input class="validate[required]" type="text" name="bill_state"/>
						</li>
						<li>
							<label>Country</label>
							<abbr title="required">*</abbr>
							{{ Form::select('bill_country', $countries ) }}

						</li>
					</ul>
					<h4>Credit Card Payment Option</h4>
					<ul>
						<li class="online-payment">
							<label>Name</label>
							<abbr title="required">*</abbr>
							<input class="validate[required]" type="text" name="cc_name"/>
						</li>
						<li class="online-payment">
							<label>Card Number</label>
							<abbr title="required">*</abbr>
							<input autocomplete="off" class="validate[required]" type="text" name="cc_num" />

							<img class="cards" src="/img/icons/mastercard.png" alt="Mastercard"/>
							<img class="cards" src="/img/icons/visa.png" alt="Visa"/>

						</li>
						<li class="online-payment">
							<label>CVN</label>
							<abbr title="required">*</abbr>
							<input autocomplete="off" class="validate[required]" type="text" name="cc_cvn" />
							<img id="eway" src="/img/icons/eway.png" alt="EWay" />
						</li>
						<li class="online-payment">
							<label>Expiry Date</label>
							<abbr title="required">*</abbr>
							<select name="cc_month" class="validate[required] date">
								<option value="">Please select</option>
								<option value="01">01</option>
								<option value="02">02</option>
								<option value="03">03</option>
								<option value="04">04</option>
								<option value="05">05</option>
								<option value="06">06</option>
								<option value="07">07</option>
								<option value="08">08</option>
								<option value="09">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select>
							<select name="cc_year" class="validate[required] date">
								<option value="">Please select</option>
								<option value="2013">2013</option>
								<option value="2014">2014</option>
								<option value="2015">2015</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
								<option value="2019">2019</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option>
								<option value="2022">2022</option>
								<option value="2023">2023</option>
								<option value="2024">2024</option>
								<option value="2025">2025</option>
								<option value="2026">2026</option>
								<option value="2027">2027</option>
								<option value="2028">2028</option>
								<option value="2029">2029</option>
								<option value="2030">2030</option>
								<option value="2031">2031</option>
								<option value="2032">2032</option>
								<option value="2033">2033</option>
								<option value="2034">2034</option>
								<option value="2035">2035</option>
								<option value="2036">2036</option>
								<option value="2037">2037</option>
								<option value="2038">2038</option>
								<option value="2039">2039</option>
								<option value="2040">2040</option>
								<option value="2041">2041</option>
								<option value="2042">2042</option>
							</select>
						</li>
					</ul>
					<input type="submit" class="btn btn-primary clearfix" value="Pay Now"/>
				</form>
			</div>

			<div id="paypal">
				<h6>Paypal option</h6>
				{{ Form::open('employer/payment/submit', 'POST', array('class' => 'employer-payment-form validate-form')); }}
				<input type='image' name='paypal_submit' id='paypal_submit'  src='https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif' border='0' align='top' alt='Pay with PayPal'/>
				<input type="hidden" name="success_url" value="/employer/complete" /> 
				<input type="hidden" name="cancel_url" value="/employer/cancel">				
				{{ Form::close(); }}
			</div>
		</div>
	</div>

</div>

@endsection


@section('LAB-script')

.script('https://www.paypalobjects.com/js/external/dg.js').wait( function () {
dg = new PAYPAL.apps.DGFlow({
trigger: 'paypal_submit',
expType: 'instant'
});
})

@endsection