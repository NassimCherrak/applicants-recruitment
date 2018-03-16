@extends('applicants.layouts.master')

@section('content')


<div class="body-content">
	<div class="module">

		<h3 class="content-title">Placeholder</h3>
		<div class="alert alert-error form-style grid-container">

			<form class="edit-form grid-item">
				<label><span>First Name: </span>
					<input type="text" class="input-field" placeholder="first name" name="firstName" required/>
				</label>
				<label><span>Last Name: </span>
					<input type="text" class="input-field" placeholder="last name" name="lastName" required/>
				</label>
				<label><span>Comment: </span>
					<textarea  name="comment" class="textarea-field" placeholder="Write your comment here"></textarea>
				</label>
				<input class="button1" type="submit" value="SAVE">
			</form>
			<form class="select-form grid-item">
				<label><span>Name: </span>
					<select name="registered-names" class="select-field restricted-select">
						<option>please select</option>
					</select>
				</label>
			</form>

		</div>
	</div>
</div>

@endsection