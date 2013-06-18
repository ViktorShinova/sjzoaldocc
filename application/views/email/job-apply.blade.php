@include('email.header')
																		<p align="center" class="article-title">Application for {{ $data['job']['title'] }}</p>
																			<table class="w580 article-content" width="580" cellpadding="0" cellspacing="0" border="0">
																				<tr>
																					<td><strong>Job URL</strong></td>
																					<td><a href="careershire.localhost/job/article/3" target="_blank">http://careershire.localhost/job/article/{{ $data['job']['id'] }}</a></td>
																				</tr>
																				<tr>
																					<td>&nbsp;</td>
																					<td>&nbsp;</td>
																				</tr>
																				<tr>
																					<td colspan="2"><hr/></td>
																				</tr>
																				<tr>
																					<td>&nbsp;</td>
																					<td>&nbsp;</td>
																				</tr>
																				//<?php
//																					//non-registered users
//																					if(isset($data['applicant']['non_registered_users'])) {
//																						$applicant = unserialize( $data['applicant']['non_registered_users'] );
//																						
//																						
//																						$first_name = $applicant['first_name'];
//																						$last_name = $applicant['last_name'];
//																						$email = $applicant['email'];
//																						$contact_number = $applicant['contact'];
//																						//list($first_name, $last_name, $email, $contact_number) = unserialize($data['applicant']['non_registered_users']);
//																					}
//
//																					//registered users
//																					if(isset($data['applicant']['alternate_contact_details'])) {
//																						list($email, $contact_number) = unserialize($data['applicant']['alternate_contact_details']);
//																						$first_name = $data['applicant']['first_name'];
//																						$last_name = $data['applicant']['last_name'];
//																					}
//
//																				?>
																				<tr>
																					<td><strong>First Name</strong></td>
																					<td>{{ $data['submissionData']['first_name'] }}</td>
																				</tr>
																				<tr>
																					<td><strong>Last Name</strong></td>
																					<td>{{ $data['submissionData']['last_name'] }}</td>
																				</tr>
																				<tr>
																					<td><strong>Email</strong></td>
																					<td>{{ $data['submissionData']['email'] }}</td>
																				</tr>
																				<tr>
																					<td><strong>Contact Number</strong></td>
																					<td>{{ $data['submissionData']['contact'] }}</td>
																				</tr>
																				<tr>
																					<td><strong>Current Employment</strong></td>
																					<td>{{ $data['submissionData']['current_employment'] }}</td>
																				</tr>
																				<tr>
																					<td><strong>Duration</strong></td>
																					<td>{{ $data['submissionData']['duration_year']}} year(s), {{$data['submissionData']['duration_month']}} month(s)</td>
																				</tr>
																				@if( isset($data['applicant']['slug']) )
																				<tr>
																					<td><strong>Public Profile</strong></td>
																					<td><a href="#">http://www.careershire.com.au/applicant/public/{{ $data['applicant']['slug'] }}</a></td>
																				</tr>
																				@endif
																				<tr>
																					<td>&nbsp;</td>
																					<td>&nbsp;</td>
																				</tr>
																				
																				@if( $data['applicant']['attachments']['resume']['error'] == 0 )
																				<tr valign="top">
																					<td><strong>Attached Resume</strong></td>
																					<td>{{ $data['applicant']['attachments']['resume']['name'] }}</td>
																				</tr>
																				@endif
																				<tr>
																					<td>&nbsp;</td>
																					<td>&nbsp;</td>
																				</tr>
																				@if( $data['applicant']['write_coverletter'] != "" )
																				<tr valign="top">
																					<td width="142"><strong>Coverletter</strong></td>
																					<td width="438">{{ $data['applicant']['write_coverletter'] }}</td>
																				</tr>
																				@endif
																				@if( $data['applicant']['attachments']['coverletter']['error'] == 0 )
																				<tr valign="top">
																					<td><strong>Attached Coverletter</strong></td>
																					<td>{{ $data['applicant']['attachments']['coverletter']['name'] }}</td>
																				</tr>
																				@endif
																			</table>
@include('email.footer')												  	