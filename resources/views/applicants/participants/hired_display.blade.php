<div class="col-md-8 order-md-1">
	<form class="need-validation">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-6 mb-3">
				<label for="first">First name
				</label>
				<input class="form-control" id="first" name="first_name" placeholder="" value="" disabled>
				<div class="invalid-feedback">
					Valid first name is required.
				</div>
			</div>
			<div class="col-md-6 mb-3">
				<label for="last">Last name
				</label>
				<input class="form-control" id="last" name="last_name" placeholder="" value="" disabled>
				<div class="invalid-feedback">
					Valid last name is required.
				</div>
			</div>
		</div>
		<div class="mb-3">
			<label for="email">Email
			</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="" disabled>
			<div class="invalid-feedback">
				Please enter a valid email address for shipping updates.
			</div>
		</div>
		<div class="mb-3">
			<label for="phone">Phone No.:
			</label>
			<input class="form-control" id="phone" name="phone" placeholder="1234567890" value="" disabled>
			<div class="invalid-feedback">
				Please enter a phone number.
			</div>
		</div>
		<div class="mb-3">
			<label for="department">Department
				<select class="custom-select d-block w-100" name="department" disabled>
					<option selected="selected">HR</option>
					<option>ACT</option>
					<option>IT</option>
				</select>
			</label>
		</div>
		<div class="mb-3">
			<label for="title">Job Position
			</label>
			<input class="form-control" id="title" name="title" value="" disabled>
			<div class="invalid-feedback">
				Please enter a job title.
			</div>
		</div>
		<div class="d-flex justify-content-between align-items-center mb-3">
			<label for="shift">Shift
				<select class="custom-select d-block w-100" name="shift" disabled>
					<option selected="selected">AM</option>
					<option>PM</option>
				</select>
			</label>
		</div>
		<div class="mb-3">
			<label class="control-label" for="date">Estimated Date of Completion:
			</label>
			<input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text" disabled/>
		</div>
		<div class="d-flex justify-content-between align-items-center mb-3">
			<label for="program">Program Status:
				<select class="custom-select d-block w-100" id="select-program" name="program-selected" disabled>
					<option value>please select the program status</option>
					<option>Program Completed</option>
					<option>Program Not Completed</option>
				</select>
			</label>
		</div>
		<div class="d-flex justify-content-between align-items-center mb-3">
			<label for="program">Change Status:
				<select class="custom-select d-block w-100" id="select-program" name="status" disabled>
					<option value>Select Status</option>
					<option>On Hold</option>
				</select>
			</label>
		</div>
		<div class="mb-3" id="program-status">
			<label for="program-name">Program Completed:
			</label>
			<input class="form-control" id="program-name" name="program-name" disabled>
			<div class="invalid-feedback">
				Please enter a program name.
			</div>
		</div>
		<div class="form-group">
			<label for="comment">Comment</label>
			<textarea class="form-control" id="comment" rows="3" disabled></textarea>
		</div>
		<div class="mb-3">
			<button class="btn btn-primary " name="submit" type="submit" disabled>Save</button>
		</div>
	</form>
</div>