@extends('layouts.app')

@section('content')
	<div class="pd-ltr-20 xs-pd-20-10">
		@yield('notification.message')
		<div class="form_wrapper">
			<table id="myTable" class="display">
			    <thead>
			        <tr>
			            <th>Serial No.</th>
			            <th>Business Name</th>
			            <th>Modify</th>
			        </tr>
			    </thead>
			    <tbody>
			            
			    	@foreach( $business_list as $key => $bl )
			        <tr>
			            <td>{{ $bl->id }}</td>
			            <td>{{ $bl->title }}</td>
			            <td>
			            	icon_route_url()
			            	<a href="{{ route('business.edit' , ['business_id' => $bl->id]) }}" class="btn btn-success">
			            		<i class="fa fa-pencil" aria-hidden="true"></i>
							</a>

							{!! Form::open([ 'route' => ['business.destroy', $bl->id], 'method' => 'DELETE']) !!}
								{{ Form::button('<i class="fa fa-trash-o"></i>',['class' => 'btn btn-danger', 'type' => 'submit']) }}
							{!! Form::close() !!}
			            </td>
			        </tr>
			        @endforeach
			    </tbody>
			</table>
		</div>
	</div>
@endsection