@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
	
			
			@php
			$data = [];
			foreach($services as $service){
				$data[] = [
					$service->id,
					$service->name,
					Helper::editBtn(['link'=> route('business.service.edit' , [$business_id , $service->id ] ) ]).
					Helper::destroyBtn(['link'=> route('business.service.destroy' , [$business_id , $service->id ] ) ]),
				];
			}
			@endphp
			
			{!! Helper::tableBase([
						'head' 	=> ['serial No', 'Name', 'Modify'],
						'body' => $data,
			]) !!}
	</div>
@endsection
