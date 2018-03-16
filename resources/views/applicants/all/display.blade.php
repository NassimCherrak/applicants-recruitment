@extends('applicants.layouts.master')

<?php
$myPath = "/laravel/public";
?>

@section('content')

<div class="module">
	<h3 class="content-title">All users</h3>
	<div id="body-content" class="alert alert-error row body-content">
		@if(isset($allParticipants) and $allParticipants->count() > 0)
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Department</th>
					<th scope="col">Status</th>
					<th scope="col">Program</th>
					<th scope="col">Appointment</th>
					<th scope="col">Start</th>
					<th scope="col">Departure</th>
					<th scope="col">Edit</th>
				</tr>
			</thead>
			<tbody>
				@foreach($allParticipants as $participant)
				<tr>
				<td>{{ $participant->first_name }}</td>
				<td>{{ $participant->last_name }}</td>
				<td>{{ $participant->department }}</td>
				<td>{{ $participant->status }}</td>
				<td>{{ $participant->program_status }}</td>
				<td>{{ $participant->date }}</td>
				<td>{{ $participant->start_date }}</td>
				<td>{{ $participant->end_date }}</td>
				<td>
					@switch($participant->program_status)
						@case('Program Completed')
						<form method="POST" action="<?= $myPath ?>/pcompleted">
							{{ csrf_field() }}
							<input type="hidden" value="{{ $participant->id_contact }}" name="name-selected">
							<button class="btn btn-primary " name="submit" type="submit">Edit</button>
						@break
						@case('Program Not Completed')
						<form method="POST" action="<?= $myPath ?>/pnotcompleted">
							{{ csrf_field() }}
							<input type="hidden" value="{{ $participant->id_contact }}" name="name-selected">
							<button class="btn btn-primary " name="submit" type="submit">Edit</button>
						@break
						@case('Not Started')
							@switch($participant->status)
								@case('New')
									<form method="POST" action="<?= $myPath ?>/participant">
									{{ csrf_field() }}
										<input type="hidden" value="{{ $participant->id_contact }}" name="name-selected" />
										<button class="btn btn-primary " name="submit" type="submit">Edit</button>
								@break
								@case('No Show')
									<form method="POST" action="<?= $myPath ?>/noshow">
									{{ csrf_field() }}
										<input type="hidden" value="{{ $participant->id_contact }}" name="name-selected" />
										<button class="btn btn-primary " name="submit" type="submit">Edit</button>
								@break
								@case('Not Hired')
									<form method="POST" action="<?= $myPath ?>/nothired">
									{{ csrf_field() }}
										<input type="hidden" value="{{ $participant->id_contact }}" name="name-selected" />
										<button class="btn btn-primary " name="submit" type="submit">Edit</button>
								@break
								@default
							@endswitch
						@break
						@case('Ongoing')
							@switch($participant->status)
								@case('Hired')
									<form method="POST" action="<?= $myPath ?>/hired">
									{{ csrf_field() }}
										<input type="hidden" value="{{ $participant->id_contact }}" name="name-selected" />
										<button class="btn btn-primary " name="submit" type="submit">Edit</button>
								@break
								@case('On Hold')
									<form method="POST" action="<?= $myPath ?>/onhold">
									{{ csrf_field() }}
										<input type="hidden" value="{{ $participant->id_contact }}" name="name-selected" />
										<button class="btn btn-primary " name="submit" type="submit">Edit</button>
								@break
							@endswitch
						@break
						@default
					@endswitch
					</form>
				</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="centered">
			{{ $allParticipants->links() }}
		</div>		<div>
			<form class="need-validation" method="POST" action="<?= $myPath ?>/dlall">
				{{ csrf_field() }}
				<div class="mb-3">
					<button class="btn btn-primary " name="submit-up" type="submit">Download in Word Format</button>
				</div>
			</form>
		</div>
		@endif
	</div>
</div>

@endsection