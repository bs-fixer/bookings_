@extends('layouts.app')

@section('content')
<!-- <div class="pd-ltr-20 xs-pd-20-10"> -->
	<div class="form_wrapper">
		{!! Form::open([ 'route' => ['business.service.update',$business_id, $service_id] , 'method' => 'PUT']) !!}
			<div class="form-group row">
				{{ Form::label('business_id', 'Business Id', ['class' => 'col-sm-12 col-md-2 col-form-label']) }}
				<div class="col-sm-12 col-md-10">
					{{ Form::text('business_id', $business_id , ['class' => 'form-control']) }}
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('service_name', 'Service Name', ['class' => 'col-sm-12 col-md-2 col-form-label']) }}
				<div class="col-sm-12 col-md-10">
					{{ Form::text('name', $service->name, ['class' => 'form-control']) }}
				</div>
			</div>	
			
			<div class="form-group row">
				{{ Form::button('Update',['type'=>'submit','class' => 'btn btn-primary'] )  }}
			</div>
		{!! Form::close() !!}
	</div>
<!-- </div> -->
@endsection
