@extends('applicants.layouts.master')

<?php
$myPath = "/laravel/public";
?>

@section('content')

<div class="module">
	<h3 class="content-title">Search a User</h3>
	<div id="body-content" class="alert alert-error row body-content">
		<div class="order-md-1 mb-4">
			<form class="need-validation" method="POST" action="<?= $myPath ?>/search">
				{{ csrf_field() }}
				@include ('applicants.layouts.search-form')
			</form>	
		</div>
		@if(isset($results))
		@include ('applicants.search.displayresults')
		@endif
	</div>
</div>

@endsection