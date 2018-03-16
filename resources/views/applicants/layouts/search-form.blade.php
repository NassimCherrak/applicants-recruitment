<div class="row">
	<div class="col-md-6 mb-3">
		<label for="first">First name
		</label>
		<input class="form-control" id="first" name="first_name" placeholder="" value="">
		<div class="invalid-feedback">
			Valid first name is required.
		</div>
	</div>
	<div class="col-md-6 mb-3">
		<label for="last">Last name
		</label>
		<input class="form-control" id="last" name="last_name" placeholder="" value="">
		<div class="invalid-feedback">
			Valid last name is required.
		</div>
	</div>
</div>
<div class="mb-3">
	<label for="department">Department
		<select class="custom-select d-block w-100" name="department">
			<option selected="selected"></option>
			<option>HR</option>
			<option>ACT</option>
			<option>IT</option>
		</select>
	</label>
</div>
<div class="mb-3">
	<label for="status">Status
		<select class="custom-select d-block w-100" name="status">
			<option selected="selected"></option>
			<option>New</option>
			<option>Hired</option>
			<option>No Show</option>
			<option>Not Hired</option>
			<option>Employed</option>
			<option>Not Employed</option>
			<option>On Hold</option>
		</select>
	</label>
</div>
<div class="mb-3">
	<label for="program_status">Program Status
		<select class="custom-select d-block w-100" name="program_status">
			<option selected="selected"></option>
			<option>Not Started</option>
			<option>Ongoing</option>
			<option>Program Completed</option>
			<option>Program Not Completed</option>
		</select>
	</label>
</div>
<div class="mb-3">
	<button class="btn btn-primary " name="submit" type="submit">Search</button>
</div>