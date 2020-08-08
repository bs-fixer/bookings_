@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
		{!! Form::open([ 'route' => ['business.bookings.update',$business_id, $booking_id] , 'method' => 'PUT']) !!}
			{!! Helper::wrapHtml('text_field', ['name'=>'business_id', 'label'=>'Business ID', 'value'=>$business_id , 'selected_value' => null ]) !!}
            {!! Helper::wrapHtml('select_field', ['name'=>'ref_id', 'label'=>'Select Employees', 'values'=>$employees , 'selected_value' => $name , 'multiple' => null ]) !!}
            {!! Helper::wrapHtml('select_field', ['name'=>'services', 'label'=>'Select Services', 'values'=>$services , 'selected_value' => null ,'multiple' => null ]) !!}

			{!! Helper::wrapHtml('button_field', ['name'=>'Update Booking']) !!}	
		{!! Form::close() !!}
	</div>
@endsection