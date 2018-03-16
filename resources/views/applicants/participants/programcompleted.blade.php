@extends('applicants.layouts.master')

<?php
$myPath = "/laravel/public";
?>

@section('content')

<div class="module">
	<h3 class="content-title">Program Completed</h3>
	<div id="body-content" class="alert alert-error row body-content">
		<div class="col-md-4 order-md-2 mb-4">
			<form class="need-validation" method="POST" action="<?= $myPath ?>/pcompleted">
				@include ('applicants.layouts.select-name-form')
			</form>	
		</div>
		@if(isset($selectedParticipant) and $selectedParticipant != 'please select')
			@include ('applicants.participants.pcompleted_update')
		@else
			@include ('applicants.participants.pcompleted_display')
		@endif
	</div>
</div>

@endsection