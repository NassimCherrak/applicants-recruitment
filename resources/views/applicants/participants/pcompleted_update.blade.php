<div class="col-md-8 order-md-1">
	@include ('applicants.layouts.download-resume')
	<form class="need-validation" method="POST" action="<?= $myPath ?>/upcompleted/{{ $selectedParticipant->id_contact }}" enctype="multipart/form-data">
		{{ csrf_field() }}
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
		<div class="mb-3">
			<label for="resume">Update Resume:
				<input type="file" id="resume" name="resume" accept="*">
			</label>
		</div>
		<div class="d-flex justify-content-between align-items-center mb-3">
			<label for="program">Change Status:
				<select class="custom-select d-block w-100" id="select_status" name="status">
					@switch($selectedParticipant->status)
					@case('Employed')
					<option selected="selected">Employed</option>
					<option>Not Employed</option>
					@break
					@case('Not Employed')
					<option>Employed</option>
					<option selected="selected">Not Employed</option>
					@break
					@default
					<option selected="selected">Employed</option>
					<option>Not Employed</option>
					@endswitch
				</select>
			</label>
		</div>
		<div class="mb-3">
			<label class="control-label" for="date">Date of Completion:
			</label>
			<input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text" value="{{ date('m/d/Y', strtotime($selectedParticipant->end_date)) }}">
		</div>
		<div class="form-group">
			<label for="comment">Comment</label>
			<textarea class="form-control" id="comment" name="comment" rows="3">{{ $selectedParticipant->comment }}</textarea>
		</div>
		<div class="mb-3">
			<button class="btn btn-primary " name="submit" type="submit">Save</button>
		</div>
	</form>
</div>