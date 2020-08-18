@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
		{!! Form::open([ 'route' => ['business.bookings.store',$business_id]]) !!}
			{!! Helper::wrapHtml('text_field', ['name'=>'business_id', 'label'=>'Business ID', 'value'=>$business_id , 'selected_value' => null ]) !!}
			{!! Helper::wrapHtml('text_field', ['name'=>'name', 'label'=>'Name', 'value'=>'' , 'selected_value' => null ]) !!}
			{!! Helper::wrapHtml('text_field', ['name'=>'contact', 'label'=>'Contact', 'value'=>'' , 'selected_value' => null ]) !!}
			{!! Helper::wrapHtml('email_field', [
													'name' => 'email' , 'label' => 'Email' , 'value' => '' , 
													'attributes' => ['placeholder' => 'abc@email.com' , 'class'=>'form-control'] 
												]) 
			!!}
            {!! Helper::wrapHtml('select_field', ['name'=>'ref_id', 'label'=>'Select Employees', 'values'=>$employees , 'selected_value' => null , 'multiple' => null ]) !!}
            {!! Helper::wrapHtml('select_field', ['name'=>'services', 'label'=>'Select Services', 'values'=>$services , 'selected_value' => null ,'multiple' => null ]) !!}
			{!! Helper::wrapHtml('datepicker_field', ['name'=>'dob', 'label'=>'Select Booking Day', 'value'=>null , 'selected_value' => null]) !!}
			<!-- {!! Helper::wrapHtml('date_field', ['name'=>'DOB', 'label'=>'Select Booking Day']) !!} -->
			<!-- <input name="somedate" type="date"> -->
			<div class="row bookings_slot"></div>
			{!! Helper::wrapHtml('submit_button', ['name'=>'Add Booking' , 'attributes' => [ 'class']]) !!}	
		{!! Form::close() !!}
	</div>
@endsection