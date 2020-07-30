@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
	

			{!! Helper::table([
								'th' 		    => ['serial No.' , 'Name', 'Modify'],
								'for'			=> 'service',
								'tbody_record'  => $services,
								'modify' 		=>  Helper::modifyButton( 
															['edit' => 'business.service.edit' , 'destroy' => 'business.service.destroy'] , 
															[ 
																'val1'  => $business_id,
																'val2'  => ''
															] 
														),
			]) !!}
	</div>
@endsection
