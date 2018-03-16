{{ csrf_field() }}
<div class="d-flex justify-content-between align-items-center mb-3">
	<div class="mb-3">
		<label class="control-label" for="date-list">Select Date:
		</label>
		<input class="form-control" id="date-list" name="date" placeholder="select date of appointment to download" type="text"/>
	</div>
</div>
<div class="mb-3">
	<button class="btn btn-primary " name="submit-up" type="submit">Download</button>
</div>