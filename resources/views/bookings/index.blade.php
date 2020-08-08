@extends('layouts.app')

@section('content')
	<div class="pd-ltr-20 xs-pd-20-10">
		@yield('notification.message')
		<div class="form_wrapper">
			
			@php
			$data = [];
			foreach($bookings as $key => $bl){
				$data[] = [
					$bl->id,
					$bl->business_id,
                    $name[$key],
                    $bl->services,
					Helper::editBtn(['link'=> route('business.bookings.edit' , [$business_id, $bl->id ] ) ]).
					Helper::destroyBtn(['link'=> route('business.bookings.destroy' , [$business_id, $bl->id ] ) ]),
				];
			}
			
			@endphp
			
			{!! Helper::tableBase([
						'head' 	=> ['serial No', 'Business ID', 'Employee', 'Service', 'Modify'],
						'body' => $data,
			]) !!}
			
		</div>
	</div>
@endsection