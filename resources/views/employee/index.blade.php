@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
	<!-- {!! Helper::wrapHtml('table', 
								['th'		   => ['Serial No.' , 'Name', 'Business ID',  'Modify'], 
								'tbody_record' => $employees , 
								'id' 		   => $business_id,
								'id1_name'	   => 'business_id',
								'id2_name'	   => 'e',
								'edit'		   => 'employee.edit',
								'destroy' 	   => 'employee.destroy'
								]
						) 
	!!} -->
		<!-- <table id="myTable" class="display">
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
						{!! Helper::modifyButton( ['edit' => 'employee.edit' , 'destroy' => 'employee.destroy'] , 
												[ 
													'val1'  => $business_id,
													'val2'  => $employe->id
												] 
						) !!} -->
						<!-- <a href="{{ route('employee.edit' , ['business_id' => $business_id , 'employee_id' => $employe->id ]) }}" class="btn btn-success">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</a>
						
						{!! Form::open([ 'route' => ['employee.destroy', $business_id, $employe->id], 'method' => 'DELETE']) !!}
							{{ Form::button('<i class="fa fa-trash-o"></i>',['class' => 'btn btn-danger', 'type' => 'submit']) }}
						{!! Form::close() !!} -->
					<!-- </td>
				</tr>
				@endforeach
			</tbody>
		</table> -->

		{!! Helper::table([
								'th' 		    => ['Serial No.' , 'Name',  'Modify'],
								'for'			=> 'employee',
								'tbody_record'  => $employees,
								'business_id'	=> $business_id,
								'edit'			=> 'employee.edit',
								'destroy'		=> 'employee.destroy'
		]) !!}
	</div>
@endsection