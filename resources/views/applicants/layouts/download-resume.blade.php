<div class="row">
	@if($selectedParticipant->resume_location != 'Default' and $selectedParticipant->resume_location != '')
	<div class="col-md-4 mb-3">
		<form class="need-validation" method="POST" action="{{ url('/') }}/getfirstresume/{{ $selectedParticipant->id_contact }}">
			{{ csrf_field() }}
			<div class="mb-3">
				<button class="btn btn-primary " name="submit" type="submit">Download First Resume</button>
			</div>
		</form>
	</div>
	@endif
	@if($selectedParticipant->updated_resume != 'Default' and $selectedParticipant->updated_resume != '')
	<div class="col-md-4 mb-3">
		<form class="need-validation" method="POST" action="{{ url('/') }}/getupdatedresume/{{ $selectedParticipant->id_contact }}">
			{{ csrf_field() }}
			<div class="mb-3">
				<button class="btn btn-primary " name="submit" type="submit">Download Updated Resume</button>
			</div>
		</form>
	</div>
	@endif
</div>