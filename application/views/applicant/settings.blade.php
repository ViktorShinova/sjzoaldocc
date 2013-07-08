@layout('layout.level2')

@section('content')


@if ( $errors->all(':message') )
<div class="validation error">
	@foreach($errors->all(':message') as $message)
	<p>{{ $message }}</p>
	@endforeach
</div>
@endif

@if ( Session::get('success') )
<div class="alert fade in alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	Settings Saved!
</div>
@endif

<h2 class="container-header">Account Settings</h2>

<div class="row">
	
	<section class="span6 white-bg drop-shadow">

			{{ Form::open('applicant/settings/', 'POST', array('id' => 'applicant-privacy-settings', 'class' => 'form')); }}
			<div>
			<h4>Privacy Settings</h4>

			<ol>
				<li>
					<label for="contact_number">Profile Display</label>
					<div class="btn-group" data-toggle="buttons-radio" >
						<?php 
							if ($privacy_settings['profile_display_is_private'] == 0) {
								$public_state['radio'] = 'checked="checked"';
								$public_state['btn'] = 'active';
								$private_state['radio'] = '';
								$private_state['btn'] = '';
							} else {
								$public_state['radio'] = '';
								$public_state['btn'] = '';
								$private_state['radio'] = 'checked="checked"';
								$private_state['btn'] = 'active';
							}
						?>
						<button type="button" class="btn <?php echo $public_state['btn']; ?>" data-toggle="button">
							Hide
							<input type="radio" name="profile_display_is_private" <?php echo $public_state['radio']; ?> value="0"/>
						</button>
						<button type="button" class="btn <?php echo $private_state['btn']; ?>" data-toggle="button">
							Show
							<input type="radio" name="profile_display_is_private" <?php echo $private_state['radio']; ?> value="1" />
						</button>
					</div>
				</li>
				<li><hr></li>
			</ol>

			<ol>
				<li>
					<label for="contact_number">Contact number</label>
					<div class="btn-group" data-toggle="buttons-radio" >
						<?php 
							if ($privacy_settings['contact_number_is_private'] == 0) {
								$public_state['radio'] = 'checked="checked"';
								$public_state['btn'] = 'active';
								$private_state['radio'] = '';
								$private_state['btn'] = '';
							} else {
								$public_state['radio'] = '';
								$public_state['btn'] = '';
								$private_state['radio'] = 'checked="checked"';
								$private_state['btn'] = 'active';
							}
						?>
						<button type="button" class="btn <?php echo $public_state['btn']; ?>" data-toggle="button">
							Public
							<input type="radio" name="contact_number_is_private" <?php echo $public_state['radio']; ?> value="0"/>
						</button>
						<button type="button" class="btn <?php echo $private_state['btn']; ?>" data-toggle="button">
							Private
							<input type="radio" name="contact_number_is_private" <?php echo $private_state['radio']; ?> value="1" />
						</button>
					</div>
				</li>
				<li>
					<label for="email_address">Email address</label>
					<div class="btn-group" data-toggle="buttons-radio" >
						<?php 
							if ($privacy_settings['email_address_is_private'] == 0) {
								$public_state['radio'] = 'checked="checked"';
								$public_state['btn'] = 'active';
								$private_state['radio'] = '';
								$private_state['btn'] = '';
							} else {
								$public_state['radio'] = '';
								$public_state['btn'] = '';
								$private_state['radio'] = 'checked="checked"';
								$private_state['btn'] = 'active';
							}
						?>
						<button type="button" class="btn <?php echo $public_state['btn']; ?>" data-toggle="button">
							Public
							<input type="radio" name="email_address_is_private" <?php echo $public_state['radio']; ?> value="0"/>
						</button>
						<button type="button" class="btn <?php echo $private_state['btn']; ?>" data-toggle="button">
							Private
							<input type="radio" name="email_address_is_private" <?php echo $private_state['radio']; ?> value="1" />
						</button>
					</div>
				</li>
				<li><hr></li>
			</ol>


			<ol>
				<li>
					<label for="qualifications">Qualifications</label>
					<div class="btn-group" data-toggle="buttons-radio">
						<?php 
							if ($privacy_settings['qualifications_is_private'] == 0) {
								$public_state['radio'] = 'checked="checked"';
								$public_state['btn'] = 'active';
								$private_state['radio'] = '';
								$private_state['btn'] = '';
							} else {
								$public_state['radio'] = '';
								$public_state['btn'] = '';
								$private_state['radio'] = 'checked="checked"';
								$private_state['btn'] = 'active';
							}
						?>
						<button type="button" class="btn <?php echo $public_state['btn']; ?>" data-toggle="button">
							Public
							<input type="radio" name="qualifications_is_private" <?php echo $public_state['radio']; ?> value="0"/>
						</button>
						<button type="button" class="btn <?php echo $private_state['btn']; ?>" data-toggle="button">
							Private
							<input type="radio" name="qualifications_is_private" <?php echo $private_state['radio']; ?> value="1" />
						</button>
					</div>
				</li>
				<li>
					<label for="employment_history">Employment History</label>
					<div class="btn-group" data-toggle="buttons-radio" >
						<?php 
							if ($privacy_settings['employer_history_is_private'] == 0) {
								$public_state['radio'] = 'checked="checked"';
								$public_state['btn'] = 'active';
								$private_state['radio'] = '';
								$private_state['btn'] = '';
							} else {
								$public_state['radio'] = '';
								$public_state['btn'] = '';
								$private_state['radio'] = 'checked="checked"';
								$private_state['btn'] = 'active';
							}
						?>
						<button type="button" class="btn <?php echo $public_state['btn']; ?>" data-toggle="button">
							Public
							<input type="radio" name="employer_history_is_private" <?php echo $public_state['radio']; ?> value="0"/>
						</button>
						<button type="button" class="btn <?php echo $private_state['btn']; ?>" data-toggle="button">
							Private
							<input type="radio" name="employer_history_is_private" <?php echo $private_state['radio']; ?> value="1" />
						</button>
					</div>
				</li>
				<li>
					<label for="expertise">Expertise</label>
					<div class="btn-group" data-toggle="buttons-radio" >
						<?php 
							if ($privacy_settings['expertise_is_private'] == 0) {
								$public_state['radio'] = 'checked="checked"';
								$public_state['btn'] = 'active';
								$private_state['radio'] = '';
								$private_state['btn'] = '';
							} else {
								$public_state['radio'] = '';
								$public_state['btn'] = '';
								$private_state['radio'] = 'checked="checked"';
								$private_state['btn'] = 'active';
							}
						?>
						<button type="button" class="btn <?php echo $public_state['btn']; ?>" data-toggle="button">
							Public
							<input type="radio" name="expertise_is_private" <?php echo $public_state['radio']; ?> value="0"/>
						</button>
						<button type="button" class="btn <?php echo $private_state['btn']; ?>" data-toggle="button">
							Private
							<input type="radio" name="expertise_is_private" <?php echo $private_state['radio']; ?> value="1" />
						</button>
					</div>
				</li>				
				<li>
					<label for="resume">Resume</label>
					<div class="btn-group" data-toggle="buttons-radio" >
						<?php 
							if ($privacy_settings['resume_is_private'] == 0) {
								$public_state['radio'] = 'checked="checked"';
								$public_state['btn'] = 'active';
								$private_state['radio'] = '';
								$private_state['btn'] = '';
							} else {
								$public_state['radio'] = '';
								$public_state['btn'] = '';
								$private_state['radio'] = 'checked="checked"';
								$private_state['btn'] = 'active';
							}
						?>
						<button type="button" class="btn <?php echo $public_state['btn']; ?>" data-toggle="button">
							Public
							<input type="radio" name="resume_is_private" <?php echo $public_state['radio']; ?> value="0"/>
						</button>
						<button type="button" class="btn <?php echo $private_state['btn']; ?>" data-toggle="button">
							Private
							<input type="radio" name="resume_is_private" <?php echo $private_state['radio']; ?> value="1" />
						</button>
					</div>
				</li>
				<li>
					<label for="coverletters">Coverletters</label>
					<div class="btn-group" data-toggle="buttons-radio" >
						<?php 
							if ($privacy_settings['coverletters_is_private'] == 0) {
								$public_state['radio'] = 'checked="checked"';
								$public_state['btn'] = 'active';
								$private_state['radio'] = '';
								$private_state['btn'] = '';
							} else {
								$public_state['radio'] = '';
								$public_state['btn'] = '';
								$private_state['radio'] = 'checked="checked"';
								$private_state['btn'] = 'active';
							}
						?>
						<button type="button" class="btn <?php echo $public_state['btn']; ?>" data-toggle="button">
							Public
							<input type="radio" name="coverletters_is_private" <?php echo $public_state['radio']; ?> value="0"/>
						</button>
						<button type="button" class="btn <?php echo $private_state['btn']; ?>" data-toggle="button">
							Private
							<input type="radio" name="coverletters_is_private" <?php echo $private_state['radio']; ?> value="1" />
						</button>
					</div>
				</li>

				<li><hr></li>

				<li><button class="btn btn-warning" type="submit">Save</button></li>
			</ol>
		</div>
			{{ Form::close(); }}
	</section>


	<!--section class="span6 white-bg drop-shadow">
		
		<h4>Change Password</h4>

	</section-->

</div>
<!-- /.row -->

@endsection