<?php
$myPath = "/laravel/public";
?>

<div class="col-md-8 order-md-2">

	<span>{{ $results->count() }} results found.</span><hr/>
	@if($results->count() > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">First Name</th>
				<th scope="col">Last Name</th>
				<th scope="col">Department</th>
				<th scope="col">Status</th>
				<th scope="col">Program</th>
				<th scope="col">Edit</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($results as $result)

			<tr>
				<td>{{ $result->first_name }}</td>
				<td>{{ $result->last_name }}</td>
				<td>{{ $result->department }}</td>
				<td>{{ $result->status }}</td>
				<td>{{ $result->program_status }}</td>
				<td>
					@switch($result->program_status)
						@case('Program Completed')
						<form method="POST" action="<?= $myPath ?>/pcompleted">
							{{ csrf_field() }}
							<input type="hidden" value="{{ $result->id_contact }}" name="name-selected">
							<button class="btn btn-primary " name="submit" type="submit">Edit</button>
						@break
						@case('Program Not Completed')
						<form method="POST" action="<?= $myPath ?>/pnotcompleted">
							{{ csrf_field() }}
							<input type="hidden" value="{{ $result->id_contact }}" name="name-selected">
							<button class="btn btn-primary " name="submit" type="submit">Edit</button>
						@break
						@case('Not Started')
							@switch($result->status)
								@case('New')
									<form method="POST" action="<?= $myPath ?>/participant">
									{{ csrf_field() }}
										<input type="hidden" value="{{ $result->id_contact }}" name="name-selected" />
										<button class="btn btn-primary " name="submit" type="submit">Edit</button>
								@break
								@case('No Show')
									<form method="POST" action="<?= $myPath ?>/noshow">
									{{ csrf_field() }}
										<input type="hidden" value="{{ $result->id_contact }}" name="name-selected" />
										<button class="btn btn-primary " name="submit" type="submit">Edit</button>
								@break
								@case('Not Hired')
									<form method="POST" action="<?= $myPath ?>/nothired">
									{{ csrf_field() }}
										<input type="hidden" value="{{ $result->id_contact }}" name="name-selected" />
										<button class="btn btn-primary " name="submit" type="submit">Edit</button>
								@break
								@default
							@endswitch
						@break
						@case('Ongoing')
							@switch($result->status)
								@case('Hired')
									<form method="POST" action="<?= $myPath ?>/hired">
									{{ csrf_field() }}
										<input type="hidden" value="{{ $result->id_contact }}" name="name-selected" />
										<button class="btn btn-primary " name="submit" type="submit">Edit</button>
								@break
								@case('On Hold')
									<form method="POST" action="<?= $myPath ?>/onhold">
									{{ csrf_field() }}
										<input type="hidden" value="{{ $result->id_contact }}" name="name-selected" />
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
	@endif
</div>