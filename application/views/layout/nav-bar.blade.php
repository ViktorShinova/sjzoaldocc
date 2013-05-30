		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="/"><img src="/img/logo-top.png" alt="Careershire"></a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li class="active"><a href="/">Home</a></li>
							<li><a href="#">About Us</a></li>
							<li><a href="#">Pricing</a></li>
							<li><a href="#">Career Advice</a></li>
							<li><a href="/employer">Employers</a></li>
						</ul>
						<ul class="nav pull-right">
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
										<li><a href="/applicant/account"><i class="icon-book"></i> My Profile</a></li>
										<li><a href="/applicant/inbox"><i class="icon-envelope"></i> My Inbox</a></li>
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
												<li><label for="nav-username">Username</label><input type="text" id="nav-username" name="username" /></li>
												<li><label for="nav-password">Password</label><input type="password" id="nav-password" name="password" /></li>
												<li><input type="submit" class="btn btn-primary pull-right" value="Sign In" /></li>
											</ul>
										</form>	
									</li>
								</ul>
								@endif
							</li>
						</ul>							
					</div>
				</div>
			</div>
		</div>
		<!--TOP NAVIGATION BAR -->