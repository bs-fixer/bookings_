@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
		{!! Form::open([ 'route' => ['business.service.store',$business_id]]) !!}
			<div class="form-group row">
				{{ Form::label('business_id', 'Business Id', ['class' => 'col-sm-12 col-md-2 col-form-label']) }}
				<div class="col-sm-12 col-md-10">
					{{ Form::text('business_id', $business_id , ['class' => 'form-control']) }}
				</div>
			</div>

			<div class="form-group row">
				{{ Form::label('service_name', 'Service Name', ['class' => 'col-sm-12 col-md-2 col-form-label']) }}
				<div class="col-sm-12 col-md-10">
					{{ Form::text('name', '', ['placeholder' => 'Enter Service Name','class' => 'form-control']) }}
				</div>
			</div>	
			
			<div class="form-group row">
				{{ Form::button('Add Service',['type'=>'submit','class' => 'btn btn-primary'] )  }}
			</div>
		{!! Form::close() !!}
	</div>
@endsection