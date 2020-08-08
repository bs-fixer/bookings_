@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
		{!! Form::open([ 'route' => ['business.bookings.store',$business_id]]) !!}
			{!! Helper::wrapHtml('text_field', ['name'=>'business_id', 'label'=>'Business ID', 'value'=>$business_id , 'selected_value' => null ]) !!}
            {!! Helper::wrapHtml('select_field', ['name'=>'ref_id', 'label'=>'Select Employees', 'values'=>$employees , 'selected_value' => null , 'multiple' => null ]) !!}
            {!! Helper::wrapHtml('select_field', ['name'=>'services', 'label'=>'Select Services', 'values'=>$services , 'selected_value' => null ,'multiple' => null ]) !!}
			{!! Helper::wrapHtml('datepicker_field', ['name'=>'dob', 'label'=>'Select Booking Day', 'value'=>null , 'selected_value' => null]) !!}
			<!-- {!! Helper::wrapHtml('date_field', ['name'=>'DOB', 'label'=>'Select Booking Day']) !!} -->
			<!-- <input name="somedate" type="date"> -->
			{!! Helper::wrapHtml('button_field', ['name'=>'Add Booking']) !!}	
		{!! Form::close() !!}
	</div>
@endsection