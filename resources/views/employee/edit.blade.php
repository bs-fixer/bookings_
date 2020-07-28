@extends('layouts.app')

@section('content')
	<div class="form_wrapper">
		{!! Form::open([ 'route' => ['employee.update' , $business_id, $employee_id ]]) !!}
		
			{!! Helper::wrapHtml('text_field', ['name'=>'business_id', 'label'=>'Business Id', 'value'=>$business_id ]) !!}
			{!! Helper::wrapHtml('text_field', ['name'=>'name', 'label'=>'Employee Name', 'value'=>$employee->name ]) !!}
			{!! Helper::wrapHtml('select_field', ['name'=>'services[]', 'label'=>'Select Services', 'values'=>$services_list , 'selected_value' => $services ]) !!}
			
			@foreach($days as $key => $day)
				<div class="form-group dayName" data-day = "{{ $day }}">
					<div class="row">
						<label class="col-sm-12 col-md-2 col-form-label">
							{{ Form::checkbox("working_days[$day]", $day , ['class' => 'working_days']) }}
							{{$day}}
							<br>
							{{ Form::checkbox("working_hours_check[$day]", $day , ['class' => 'working_hours_check']) }}
							Working Hours
						</label>
						<div class="col-sm-12 col-md-10">
							<div class="repeater-wrap">
								{{ Form::button('+',['class' => 'btn btn-success addBtn'] ) }}
								
								<div class="repeater-container">
									@forelse( $working_hours[$day]['from'] as $key => $from )
										@php $to = $working_hours[$day]['to'][$key] @endphp
										<div class="repeater-fields repeater-to-clone">
											{{ Form::button('-',['class' => 'btn btn-danger removeBtn'] )  }}
											{{ Form::time('', $from, ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][from][]",  'name' => "working_hours[$day][from][]" ]) }}
											{{ Form::time('', $to, ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][to][]",  'name' => "working_hours[$day][to][]" ]) }}
										</div>
										@empty 
										<div class="repeater-fields repeater-to-clone">
											@php $to = $working_hours[$day]['to'][$key] @endphp
											{{ Form::button('-',['class' => 'btn btn-danger removeBtn'] )  }}
											{{ Form::time('', $from, ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][from][]" ]) }}
											{{ Form::time('', $to, ['class' => 'col-md-5' , 'data-name' => "working_hours[$day][to][]"]) }}
										</div>
									@endforelse
								</div>
							</div> <!-- repeater wrap ends -->
						</div>
					</div>
				</div>
			@endforeach
			{!! Helper::wrapHtml('button_field', ['name'=>'Update']) !!}	
		{!! Form::close() !!}
	</div>
@endsection