<div class="col-md-8 order-md-1">
	@include ('applicants.layouts.download-resume')
	<form class="need-validation" method="POST" action="<?= $myPath ?>/addpart/{{ $selectedParticipant->id_contact }}">
		{{ csrf_field() }}
		@switch($selectedParticipant->status)
		@case('Hired')
			@include ('applicants.layouts.hiredradio')
		@break
		@case('No Show')
			@include ('applicants.layouts.noshowradio')
		@break
		@case('Not Hired')
			@include ('applicants.layouts.nothiredradio')
		@break
		@default
			@include ('applicants.layouts.hiredradio')
		@endswitch
		<div class="row">
			<div class="col-md-6 mb-3">
				<label for="first">First name
				</label>
				<input class="form-control" id="first" name="first_name" placeholder="" value="{{ $selectedParticipant->first_name }}">
				<div class="invalid-feedback">
					Valid first name is required.
				</div>
			</div>
			<div class="col-md-6 mb-3">
				<label for="last">Last name
				</label>
				<input class="form-control" id="last" name="last_name" placeholder="" value="{{ $selectedParticipant->last_name }}">
				<div class="invalid-feedback">
					Valid last name is required.
				</div>
			</div>
		</div>
		<div class="mb-3">
			<label for="email">Email
			</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="{{ $selectedParticipant->email }}">
			<div class="invalid-feedback">
				Please enter a valid email address for shipping updates.
			</div>
		</div>
		<div class="mb-3">
			<label for="phone">Phone No.:
			</label>
			<input class="form-control" id="phone" name="phone" placeholder="1234567890" value="{{ $selectedParticipant->phone }}">
			<div class="invalid-feedback">
				Please enter a phone number.
			</div>
		</div>
		<div class="mb-3" id="hired-option-1">
			<label for="department">Department
				<select class="custom-select d-block w-100" name="department">
					@switch($selectedParticipant->department)
					@case('HR')
					<option selected="selected">HR</option>
					<option>ACT</option>
					<option>IT</option>
					@break
					@case('ACT')
					<option>HR</option>
					<option selected="selected">ACT</option>
					<option>IT</option>
					@break
					@case('IT')
					<option>HR</option>
					<option>ACT</option>
					<option selected="selected">IT</option>
					@break
					@default
					<option selected="selected">HR</option>
					<option>ACT</option>
					<option>IT</option>
					@endswitch
				</select>
			</label>
		</div>
		<div class="mb-3" id="hired-option-2">
			<label for="title">Job Position
			</label>
			<input class="form-control" id="title" name="title" value="{{ $selectedParticipant->title }}">
			<div class="invalid-feedback">
				Please enter a job title.
			</div>
		</div>
		<div class="d-flex justify-content-between align-items-center mb-3">
			<label id="hired-option-3" for="shift">Shift
				<select class="custom-select d-block w-100" name="shift">
					@if($selectedParticipant->shift == 'AM')
					<option selected="selected">AM</option>
					<option>PM</option>
					@else
					<option>AM</option>
					<option selected="selected">PM</option>
					@endif
				</select>
			</label>
		</div>
		<div class="mb-3" id="hired-option-4">
			<label class="control-label" for="date">Start Date:
			</label>
			<input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
		</div>
		<div class="form-group">
			<label for="comment">Comment</label>
			<textarea class="form-control" id="comment" name="comment" rows="3">{{ $selectedParticipant->comment }}</textarea>
		</div>
		<div class="mb-3">
			<button class="btn btn-primary " name="submit" type="submit">Save</button>
		</div>
	</form>
	@if(count($errors))
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
</div>
