@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
		<table id="myTable" class="display">
		    <thead>
		        <tr>
		            <th>Serial No.</th>
		            <th>Name</th>
		            <th>Modify</th>
		        </tr>
		    </thead>
		    <tbody>

		    	@foreach( $services as $service )
		        <tr>
		            <td>{{ $service->id }}</td>
		            <td>{{ $service->name }}</td>
		            <td>
		            	<a href="{{ route('business.service.edit', ['business_id' => $business_id , 'service_id' => $service->id ]) }}" class="btn btn-success">
		            		<i class="fa fa-pencil" aria-hidden="true"></i>
						</a>

						{!! Form::open([ 'route' => ['business.service.destroy', $business_id, $service->id], 'method' => 'DELETE']) !!}
							{{ Form::button('<i class="fa fa-trash-o"></i>',['class' => 'btn btn-danger', 'type' => 'submit']) }}
						{!! Form::close() !!}
		            </td>
		        </tr>
		        @endforeach
		    </tbody>
		</table>
	</div>
@endsection
