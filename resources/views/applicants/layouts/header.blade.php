<header>
	<div id="logo">
		<a href="{{ url('/') }}"><img src="{{ url('/') }}/simpact-logo.jpg" /></a>
	</div>

	<div id="page-header">
		<nav class="option-menu">
			<ul>
				<li id="menu-e1"><a href="{{ url('/') }}/appointment">Appointments</a></li>
				<li id="menu-e2">
					<a href="new-participant">Participants</a>
					<ul id="sub-menu1">
						<a href="{{ url('/') }}/new-participant"><li id="new-applicant">New Applicants</li></a>
						<a href="{{ url('/') }}/hired"><li id="hired">Hired</li></a>
						<a href="{{ url('/') }}/noshow"><li id="no-show">No Show</li></a>
						<a href="{{ url('/') }}/pcompleted"><li id="program-completed">Program Completed</li></a>
						<a href="{{ url('/') }}/nothired"><li id="not-hired">Not Hired</li>
						<a href="{{ url('/') }}/pnotcompleted"><li id="program-not-completed">Program Not Completed</li></a>
						<a href="{{ url('/') }}/onhold"><li id="on-hold">On Hold</li></a>
					</ul>
				</li>
				<li id="menu-e3"><a href="#">Information Archieved</a></li>
			</ul>
		</nav>
	</div>
</header>