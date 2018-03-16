<div class="col-md-8 order-md-1">
	<form class="need-validation" method="POST" action="<?= $myPath ?>/overapp/{{ $selectedContact->id_contact }}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-6 mb-3">
				<label for="first">First name
				</label>
				<input class="form-control" id="first" name="first_name" placeholder="" value="{{ $selectedContact->first_name }}">
				<div class="invalid-feedback">
					Valid first name is required.
				</div>
			</div>
			<div class="col-md-6 mb-3">
				<label for="last">Last name
				</label>
				<input class="form-control" id="last" name="last_name" placeholder="" value="{{ $selectedContact->last_name }}">
				<div class="invalid-feedback">
					Valid last name is required.
				</div>
			</div>
		</div>
		<div class="mb-3">
			<label for="email">Email
			</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="{{ $selectedContact->email }}">
			<div class="invalid-feedback">
				Please enter a valid email address for shipping updates.
			</div>
		</div>
		<div class="mb-3">
			<label for="phone">Phone No.:
			</label>
			<input class="form-control" id="phone" name="phone" placeholder="1234567890" value="{{ $selectedContact->phone }}">
			<div class="invalid-feedback">
				Please enter a phone number.
			</div>
		</div>
		<div class="mb-3">
			<label for="department">Department
				<select class="custom-select d-block w-100" name="department">
					@switch($selectedContact->department)
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
		<div class="mb-3">
			<label for="resume">Upload Resume:
				<input type="file" id="resume" name="resume" accept="*">
			</label>
		</div>
		<div class="mb-3">
			<label class="control-label" for="date">Appointment Date:
			</label>
			<input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text" value="{{ date('m/d/Y', strtotime($selectedContact->date)) }}"/>
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