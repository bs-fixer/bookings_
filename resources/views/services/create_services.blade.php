@extends('layouts.app')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
	<div class="form_wrapper">
		<form method="POST" action="{{ route('storeService', ['business_id' => $business_id]) }}">
			@csrf
			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Business Id</label>
				<div class="col-sm-12 col-md-10">
					<input class="form-control" type="text" value="{{ $business_id }}" name="business_id">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Service Name</label>
				<div class="col-sm-12 col-md-10">
					<input class="form-control" type="text" placeholder="Service Name.." name="name">
				</div>
			</div>

			<div class="form-group row">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
@endsection