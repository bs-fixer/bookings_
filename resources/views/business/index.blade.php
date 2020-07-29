@extends('layouts.app')

@section('content')
	<div class="pd-ltr-20 xs-pd-20-10">
		@yield('notification.message')
		<div class="form_wrapper">
			{!! Helper::wrapHtml('table', 
										['th'		   => ['Serial No.' , 'Name', 'Modify'], 
										'tbody_record' => $business_list , 
										'id' 		   => 'e',
										'id1_name'	   => 'business_id',
										'id2_name'	   => 'e',
										'edit'		   => 'business.edit',
										'destroy' 	   => 'business.destroy'
										]
								) 
			!!}
			
		</div>
	</div>
@endsection