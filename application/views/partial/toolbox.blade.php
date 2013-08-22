<ul class="reg-toolbar pull-right">
	@if ( !Auth::check() ) 
	<li>
		<a href="/register">Register</a>
	</li>
	@endif

	<li class="dropdown">
		@if ( Auth::check() ) 
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ Auth::user()->username }} <b class="caret"></b></a>
		<ul class="dropdown-menu">

			@if( Auth::user()->role_id == 1 )
			<li><a href="/employer/post/list"><i class="icon-book"></i> My Dashboard</a></li>
			@else
			<li><a href="/applicant/account/"><i class="icon-book"></i> My Profile</a></li>
			<li><a href="/applicant/inbox/"><i class="icon-envelope-alt"></i> My Inbox</a></li>
			<li><a href="/applicant/shortlists/"><i class="icon-bookmark"></i> My Shortlist</a></li>
			@endif


			<li class="divider"></li>
			<li><a href="/logout"><i class="icon-off"></i> Sign Out</a></li>

		</ul>

		@else

		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Sign in <b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li>
				<form class="login" action="/home/login" method="post" style="padding: 15px;">
					<ul>
						<li><label for="nav-username">Email/Username</label><input type="text" id="nav-username" name="username" class="input-xlarge"/></li>
						<li><label for="nav-password">Password</label><input type="password" id="nav-password" name="password"  class="input-xlarge" /></li>
						<li><input type="submit" class="btn pull-right" value="Sign In" /></li>
					</ul>
				</form>	
			</li>
		</ul>
		@endif
	</li>
</ul>