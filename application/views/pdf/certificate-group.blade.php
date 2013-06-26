<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<style>
			body {
				font-size: 0.7em;
				font-family: Helvetica, Verdana, Arial, Sans-serif;
				background-color: #ffffff;
				padding: 10px 20px 20px 20px;
			}

			tr, td, th, table {
				margin: 0px;
				border: 0px;
				padding: 0px;
				outline: 0px;
				border-collapse: separate;
				border-spacing: 0px;
			}

			a:link, a:visited, a:hover {
				text-decoration: underline;
			}

			a {
				color: #54562e;
			}

			strong, b {
				font-weight: bold;
			}

			h1 {
				font-size: 1.6em;
				margin: 0px;
				border: 0px;
				padding: 0px;
				color: #0060ff;
			}

			.t_label {
				background-color: #f3f3f3;
				font-weight: bold;
				width: 12em;
			}

			.t_data {
				background-color: #f3f3f3;
			}

			#header_table {
				width: 100%;
			}

			#insure_header {
				width: 75%;
			}

			#insure_header h1 {
				margin-top: 1.8em;
			}

			#container {
				width: 65.4em;
				margin: 0px auto;
			}

			#logo {
				text-align: right;
			}

			#logo img {
				width: 13em;
				height: 6em;
			}

			#bottom_text {
				font-size: 10px;
			}

			#top_text, #bottom_text, #page_two {
				text-align: justify;
				padding: 10px 0px 10px 0px;
			}

			#page_two {
				page-break-before: always;
				padding-top: 30px;
			}

			#cData {
				width: 100%;
			}

			#cData td {
				vertical-align: top;
				padding: 0.3em 1em 0.3em 0.5em;
				border: thick solid #ffffff;
				border-width: 0em medium medium 0em;
			}

			#footer {
				text-align: center;
			}

			/* Emergency card */
			#intro {
				margin: 10px 0;
				padding: 0 100px;
				text-align: center;
				font-family: 'Helvetica';
			}
			#bg {
				background-color: #dce6f2;
				font-family: 'Helvetica';
				padding: 20px;
			}
			#card {
				border: dashed 1px #4f81bd;
				text-align: left;
			}
			#header {
				background-color: #fff;
				border-collapse: collapse;
			}
			#header td {
				padding: 15px;
				font-size: 12pt;
			}
			#content td {
				color: #4f81bd;
				width: 50%;
				padding: 5px 10px;
				font-size: 10pt;
			}
			table {
				width: 100%;
			}
			td.label {
				color: #fff;
				width: 70px;
				font-size: 6pt;
				padding: 3px;
			}
			.left {
				border-right: dashed 1px #fff;
			}
			.value {
				background-color: #FFF;
				color: #000;
				font-size: 12pt;
				padding: 5px;
			}
			#instructions {
				color: #4f81bd;
				font-weight: bold;
				font-size: 9pt;
				margin-top: 10px;
			}
		</style>
	</head>
	<body>

		<div id="container">

			<img src="{{ $images_dir }}/logo-wide.png" alt="" />

			<div id="top_text">
				<h1>Lloyd's Travel Insurance Certificate - Tax Invoice</h1>
				Effected through Online Insurance Brokers Pty Ltd (AFS Licence 241055; ABN 21 095 612 276), hereinafter called the Coverholder.<br />
				<br />
				This is your travel insurance certificate and should be read in conjunction with your <a href="https://{{ $host }}/pds">Product Disclosure Statement</a> which includes your policy wording. You will need both documents in the event of a claim. If you have requested your documents to be sent by post, they should arrive shortly. Thank you for choosing GoSafe travel insurance. If you require any assistance, please do not hesitate to contact us by mailing <a href="mailto:travel@gosafetravelinsurance.com.au">travel@gosafetravelinsurance.com.au</a>.<br />
				<br />
			</div>

			<h1>Schedule</h1>

			<br />

			<table id="cData">
				<tbody>
					<tr>
						<td class="t_label">Your premium is</td>
						<td class="t_data">${{ number_format($policy->gross_cost, 2) }}</td>
						<td class="t_label">Stamp Duty</td>
						<td class="t_data">${{ number_format($policy->stamp_duty, 2) }} </td>
					</tr>
					<tr>
						<td class="t_label">Postage</td>
						<td class="t_data">${{ number_format($policy->postage, 2) }}</td>
						<td class="t_label">GST</td>
						<td class="t_data">{{ $policy->is_australia() ? '$' . number_format($policy->gross_cost / 11, 2) : 'N/A' }}</td>
					</tr>
					<tr>
						<td class="t_label">Certificate number</td>
						<td class="t_data">{{ $policy->reference }}</td>
						<td class="t_label">Total period</td>
						<td class="t_data">{{ $policy->num_days }} days</td>
					</tr>
					<tr>
						<td class="t_label">Level of cover</td>
						<td class="t_data">{{ e($policy->level->name) }}</td>
						<td class="t_label">Area of cover</td>
						<td class="t_data">{{ e($policy->area->name) }}</td>
					</tr>
					<tr>
						<td class="t_label">Insurance effective from</td>
						<td class="t_data">{{ App::date($policy->created_at, 'j F Y, g:ia') }} EST</td>
						<td class="t_label">Contact address</td>
						<td class="t_data">
							{{ e($policy->address) }}<br />
							{{ e($policy->suburb . ' ' . $policy->state . ' ' . $policy->postcode) }}
						</td>
					</tr>
					<tr>
						<td class="t_label">Policy start date</td>
						<td class="t_data">{{ App::date($policy->start_date, 'j F Y') }}</td>
						<td class="t_label">Contact number</td>
						<td class="t_data">{{ e($policy->phone) }}</td>
					</tr>
					<tr>
						<td class="t_label">Policy end date</td>
						<td class="t_data">{{ App::date($policy->end_date, 'j F Y') }}</td>
						<td class="t_label">Email address</td>
						<td class="t_data">{{ e($policy->email) }}</td>
					</tr>
					<tr>
						<td class="t_label">Return or one-way</td>
						<td class="t_data">{{ $policy->return ? 'Return' : 'One-way' }}</td>
						<td class="t_label"></td>
						<td class="t_data"></td>
					</tr>

					@if ($policy->area->name == 'Worldwide inc USA & Canada')
						<tr>
							<td class="t_label">Start inc USA &amp; Canada</td>
							<td class="t_data">{{ App::date($policy->usa_start_date, 'j F Y') }}</td>
							<td class="t_label">&nbsp;</td>
							<td class="t_data">&nbsp;</td>
						</tr>
						<tr>
							<td class="t_label">End inc USA &amp; Canada</td>
							<td class="t_data">{{ App::date($policy->usa_end_date, 'j F Y') }}</td>
							<td class="t_label">&nbsp;</td>
							<td class="t_data">&nbsp;</td>
						</tr>
					@endif

					<tr>
						<td class="t_label">Insured Persons:</td>
						<td class="t_data">
							@foreach ($policy->insurees as $insuree)
								{{ e($insuree->first_name . ' ' . $insuree->surname . ' (' . $insuree->age . ')') }}<br />
							@endforeach
						</td>
						<td class="t_label">&nbsp;</td>
						<td class="t_data">&nbsp;</td>
					</tr>

					<tr>
						<td class="t_label">Snow sports cover</td>
						<td class="t_data">{{ $policy->snow_num_days ? 'Yes' : 'No' }}</td>
						@if ($policy->return)
							<td class="t_label"></td>
							<td class="t_data"></td>
						@else
							<td class="t_label">Final destination</td>
							<td class="t_data">{{ e($policy->final_destination->name) }}</td>
						@endif
					</tr>

					@if ($policy->snow_num_days)
						<tr>
							<td class="t_label">Snow sports cover start</td>
							<td class="t_data">{{ App::date($policy->snow_start_date, 'j F Y') }}</td>
							<td class="t_data" colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td class="t_label">Snow sports cover end</td>
							<td class="t_data">{{ App::date($policy->snow_end_date, 'j F Y') }}</td>
							<td class="t_data" colspan="2">&nbsp;</td>
						</tr>
					@endif

					@if ($policy->voucher_code)
						<tr>
							<td class="t_label">Voucher code</td>
							<td class="t_data">{{ e($policy->voucher_code) }}</td>
							<td class="t_data" colspan="2">&nbsp;</td>
						</tr>
					@endif
				</tbody>
			</table>

			<div id="bottom_text">
				<strong>One Assist 24 Hour Medical Emergency Assistance - +44 (0) 1992 444 337 -</strong> Please refer to the procedure as shown on page 10 in your Product Disclosure Statement.<br />
				<br />
				<strong>Claims Service - +61 7 3005 1613 -</strong> In the event of a claim arising under this insurance, contact Gallagher Bassett email <a href="mailto:brisclaims@gbtpa.com.au">brisclaims@gbtpa.com.au</a>.<br />
				<br />
			</div>

			<br />
			<img alt="Lloyds" src="{{ $images_dir }}/lloyds.gif" width="118" height="47" /><br />
			<br />

			THIS CERTIFICATE OF INSURANCE confirms that in return for payment of the Premium shown in the Schedule, certain Underwriters at Lloyd's have agreed to insure you, in accordance with the policy wording provided.<br />
			<br />
			You can obtain further details of the syndicate numbers and the proportions of this Insurance for which each of the Underwriters at Lloyd's is liable by requesting them from the Coverholder shown below. In the event of loss, each Underwriter (and their Executors and Administrators) is only liable for their own share of the loss.<br />
			<br />
			In accepting this Insurance, the Underwriters have relied on the information and statements that you have provided on the online application form, the date of which is stated in the Schedule. You should read this Certificate carefully and if it is not correct contact the Coverholder. It is an important document and you should keep it in a safe place with all other papers relating to this Insurance.<br />
			<br />

			<div id="page_two">
				This Certificate is Insurance Council of Australia's General Insurance Code of Practice compliant, apart from any claims adjusted outside Australia. Underwriters at Lloyd's proudly support the General Insurance Code of Practice. The purpose of the Code is to raise standards of practice and service in the general insurance industry. Any enquiry or complaint relating to this Insurance should be referred to the Coverholder shown above in the first instance. If this does not resolve the matter or you are not satisfied with the way a complaint has been dealt with, you should write to:<br />
				<br />
				Lloyd's Underwriters' General Representative in Australia Suite 2, Level 21 Angel Place 123 Pitt Street<br />
				<br />
				Sydney NSW 2000 Telephone Number: (02) 9223 1433 Facsimile Number: (02) 9223 1466<br />
				<br />
				If your dispute remains unresolved you may be referred to the Financial Ombudsman Service Limited under the terms of the General Insurance Code of Practice. For other disputes you will be referred to other proceedings for resolution. Details are available from Lloyd's Underwriters' General Representative in Australia at the address above.<br />
				<br />
				The Underwriters accepting this Insurance agree that:<br />
				<br />
				(i) if a dispute arises under this Insurance, this Insurance will be subject to Australian law and practice and the Underwriters will submit to the jurisdiction of any competent Court in the Commonwealth of Australia;<br />
				<br />
				(ii) any summons notice or process to be served upon the Underwriters may be served upon:<br />
				<br />
				Lloyd's Underwriters' General Representative in Australia, Suite 2, Level 21 Angel Place 123 Pitt Street Sydney NSW 2000 who has authority to accept service and to appear on the Underwriters' behalf;<br />
				<br />
				(iii) if a suit is instituted against any of the Underwriters, all Underwriters participating in this Insurance will abide by the final decision of such Court or any competent Appellate Court.<br />
				<br />
				This Certificate is issued by the Coverholder shown above in accordance with the authority granted to them by certain Underwriters at Lloyd's under the Agreement referred to in the Schedule.<br />
				<br />
				IN WITNESS WHEREOF this Certificate has been by the Coverholder<br />
				<br />
				<img alt="Signature" src="{{ $images_dir }}/sig-print.gif" width="250" /><br />
				<br />

				<div id="emergency-card">
					<div id="intro">
						<p>Please find your 24/7 Medical Emergency card below. Please cut this out and keep with you when travelling. Have a great trip! The GoSafe Team</p>
					</div>
					<div id="bg">
						<div id="card">
							<table id="header">
								<tr>
									<td><font color="#4f81bd"><b>24/7 Overseas Medical Emergency Card</b></font></td>
									<td align="right"><img src="{{ $images_dir }}/logo-emergency-card.png" /></td>
								</tr>
							</table>
							<table id="content">
								<tr>
									<td class="left"><font size="4"><b>Your certificate number</b></font></td>
									<td><font size="4"><b>One Assist contact number</b></font></td>
								</tr>
								<tr>
									<td class="left"><div class="value">{{ $policy->reference }}</div></td>
									<td><div class="value">Tel: +44 (0) 1992 444 337</div></td>
								</tr>
								<tr>
									<td class="left">www.gosafetravelinsurance.com.au</td>
									<td>IMPORTANT - Call in medical emergencies only</td>
								</tr>
							</table>
						</div>
						<div id="instructions">Cut and fold in half. Carry with you when travelling for instant reference.</div>
					</div>
				</div>

			</div>

			<div id="footer">
				Travel insurance issued by Online Insurance Brokers Pty Ltd - Australian Financial Services Licence 241055<br />
				<a href="mailto:travel@gosafetravelinsurance.com.au">travel@gosafetravelinsurance.com.au</a>
			</div>

		</div>
	</div>

</body>
</html>