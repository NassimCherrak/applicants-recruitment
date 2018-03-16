@extends('applicants.layouts.master')

@section('content')

<div class="module">
	<div id="body-content" class="alert alert-error row body-content">
		<div id="welcome">
			<h2>Welcome 
				@guest
				@else
				{{ Auth::user()->name }}
				@endguest
				, please select an option to get started.</h2>
		</div>
	</div>
</div>

@endsection