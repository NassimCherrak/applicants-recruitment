<div class="col-md-8 order-md-1">
	<form class="need-validation">
		{{ csrf_field() }}
		<div class="form-check">
			<label>
				<input type="radio" name="status" disabled> <span class="label-text">Hired</span>
			</label>
		</div>
		<div class="form-check">
			<label>
				<input type="radio" name="status" disabled> <span class="label-text">No Show</span>
			</label>
		</div>
		<div class="form-check">
			<label>
				<input type="radio" name="status" disabled> <span class="label-text">Not Hired</span>
			</label>
		</div>
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
			<input class="form-control" id="phone" name="phone" placeholder="1234567890" disabled>
			<div class="invalid-feedback">
				Please enter a phone number.
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
