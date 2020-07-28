@extends('layouts.app')

@section('content')
<!-- <div class="pd-ltr-20 xs-pd-20-10"> -->
	<div class="form_wrapper">
		{!! Form::open([ 'route' => ['business.service.update',$business_id, $service_id] , 'method' => 'PUT']) !!}
			
			{!! Helper::wrapHtml('text_field', ['name'=>'business_id', 'label'=>'Business Id', 'value'=>$business_id ]) !!}
			{!! Helper::wrapHtml('text_field', ['name'=>'name', 'label'=>'Service Name', 'value'=>$service->name ]) !!}
			{!! Helper::wrapHtml('button_field', ['name'=>'Update']) !!}
		{!! Form::close() !!}
	</div>
<!-- </div> -->
@endsection
