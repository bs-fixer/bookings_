@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
		<table id="myTable" class="display">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Employee Name</th>
					<th>Business ID</th>
					<th>Modify</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $employees as $employe )
				<tr>
					<td>{{ $employe->id }}</td>
					<td>{{ $employe->name }}</td>
					<td>{{ $employe->business_id }}</td>
					<td>
						<a href="{{ route('employee.edit' , ['business_id' => $business_id , 'employee_id' => $employe->id ]) }}" class="btn btn-success">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</a>
						
						{!! Form::open([ 'route' => ['employee.destroy', $business_id, $employe->id], 'method' => 'DELETE']) !!}
							{{ Form::button('<i class="fa fa-trash-o"></i>',['class' => 'btn btn-danger', 'type' => 'submit']) }}
						{!! Form::close() !!}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection