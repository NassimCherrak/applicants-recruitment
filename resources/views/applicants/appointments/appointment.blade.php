@extends('applicants.layouts.master')

<?php
$myPath = "/laravel/public";
?>

@section('content')

<div class="module">
	<h3 class="content-title">Create or Edit an Appointment</h3>
	<div id="body-content" class="alert alert-error row body-content">
		<div class="col-md-4 order-md-2 mb-4">
			<form class="need-validation" method="POST" action="<?= $myPath ?>/appointment">
				@include ('applicants.layouts.select-name-form')
			</form>
			<form class="need-validation" method="POST" action="<?= $myPath ?>/createWord">
				@include ('applicants.layouts.download-appointments')
			</form>
		</div>
		@if(isset($selectedContact) and $selectedContact != 'please select')
		@include ('applicants.appointments.update_appointment')
		@else
		@include ('applicants.appointments.create_appointment')
		@endif
	</div>
</div>
</div>

@endsection