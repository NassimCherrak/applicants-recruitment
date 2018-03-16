@extends('applicants.layouts.master')

@section('content')

<div class="module">
	<div id="body-content" class="alert alert-error row body-content">
		<div id="welcome">
			<h2>Thank you 
				@guest
				@else
				{{ Auth::user()->name }}
				@endguest
				, you request was completed.</h2>
			@if(isset($address))
			<span>Click <a href="{{ url('/'.$address) }}">here</a> to perform a similar action.</span>
			@endif
		</div>
	</div>
</div>

@endsection