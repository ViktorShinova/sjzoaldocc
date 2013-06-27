@layout('layout.employer')
@section('page-id')page-details@endsection
@section('content')
<h2>Candidate search</h2>

<div class="content">
	<p>The candidate search feature allows you to search for your desired candidates without the need for them to apply for the job.  </p>
	<p><em>Please note that search results may be inconsistent due to the fact that these candidates did not specify the suitable resume for your job. The system will get the latest resume from the candidate's account</em></p>
	<br/>
	<div id="search-toolbar">
		<div class="input-append">
			<input class="span4" id="prependedInput" type="text" placeholder="Keywords" name="keywords"/>
			<button class="btn" type="button"><i class="icon-search"></i> Search</button>
		</div>

		<div class="btn-group pull-right">
			<button class="btn"><i class="icon-th-list"></i></button>
			<button class="btn"><i class="icon-th"></i></button>
		</div>
		<!--AJAX SORT -->
		<label>Sort by: </label>
		<select name='sort'>
			<option>Most relevant (Skill Set)</option>
			<option>Name</option>
			<option>Qualification</option>
			<option>Work Experience</option>
		</select>

	</div>

	<br/>

	<section id='result-list'>

		<ol class='listing' id='candidate-list'>

			<li>
				<span class='poptop'>
					Raise interest
				</span>
				<div class="profile-content">
					<img src='http://placecage.com/100/100'/>

					<label>Name:</label>
					<p>First Name, Last Name </p>

					<label>Skills:</label>
					<p>ALl the skills sets, ALl the skill sets</p>
					<label>Contact Details:</label>
					<p>zlkoh.damien@gmail.com</p>
				</div>
				<div class='sidebar'>
					<a class='btn' rel='popup'><i class='icon-book'></i> Resume</a>
					<a class='btn' rel='popup'>Qualifications</a>
					<a class='btn' rel='popup'><i class='icon-time'></i> Work History</a>
					<a class='btn' rel='popup'><i class='icon-user'></i> View Profile</a>
				</div>

			</li>
			

		</ol>


	</section>


</div>

@endsection