@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
	

			{!! Helper::table([
								'th' 		    => ['serial No.' , 'Name', 'Modify'],
								'for'			=> 'service',
								'tbody_record'  => $services,
								'business_id'	=> $business_id,
								'edit'			=> 'business.service.edit',
								'destroy'		=> 'business.service.destroy'
			]) !!}
	</div>
@endsection
