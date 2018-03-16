{{ csrf_field() }}
<div class="d-flex justify-content-between align-items-center mb-3">
	<label for="name">Name:
		<select class="custom-select d-block w-100" name="name-selected">
			<option value>please select</option>
			@foreach($contacts as $contact)
			<option value="{{ $contact->id_contact }}">{{ $contact->last_name }} {{ $contact->first_name }}</option>
			@endforeach
		</select>
	</label>
</div>
<div class="mb-3">
	<button class="btn btn-primary " name="submit-up" type="submit">Update</button>
</div>
